<?php

/*
 * Migration controller
 * @author Jake Josol
 * @description Migration controller
 */

class MigrationController extends Controller
{
	const MIGRATION_DIRECTORY = "/application/build/migrations";

	public function IndexAction($parameters)
	{
		try
		{
			$migrated = array();
			$model = new MigrationModel;
			$listMigrations = $model->GetQuery("pending")->Find();

			foreach($listMigrations as $itemMigration)
			{
				$name = "migration_" . $itemMigration["name"];
				$migrated[] = $name;

				if(!class_exists($name)) throw new Exception("The specified migration class does not exist: {$name}");

				$migration = new $name;
				$migration->Up();

				$itemModel = new MigrationModel($itemMigration["id"]);
				$itemModel->SoftDelete();
			}

			return Response::Make(200, "Success", array("migrated" => $migrated))->ToJSON();
		}
		catch(Exception $ex)
		{
			return Response::Make(405, "Error", $ex->getMessage())->ToJSON();
		}
	}

	public function BaseAction($parameters)
	{
		try
		{
			$migration = new migration_base;
			$migration->Up();

			$model = new MigrationModel;
			$model->name = "base";
			$model->type = MigrationType::Make;
			$model->Save();

			$model->SoftDelete();

			return Response::Make(200, "Success", array("installedAt" => date("Y-m-d H:i:s")))->ToJSON();
		}
		catch(Exception $ex)
		{
			return Response::Make(405, "Error", $ex->getMessage())->ToJSON();
		}
	}

	public function MakeAction($parameters)
	{
		try
		{
			$name = date("YmdHis");
			$table = $parameters["name"];
			$directory = getcwd() . self::MIGRATION_DIRECTORY; 
			$filename = "migration_{$name}.php";

			$model = new MigrationModel;
			$model->name = $name;
			$model->type = MigrationType::Make;
			$model->Save();

			$file = new FileHandle($filename, $directory);
			$file->WriteLine("<?php");
			$file->WriteLine("");
			$file->WriteLine("use Warp\\Interfaces\\IMigration;");
			$file->WriteLine("");
			$file->WriteLine("class migration_{$name} implements IMigration");
			$file->WriteLine("{");
			$file->WriteLine("\tpublic function Up()");
			$file->WriteLine("\t{");
			$file->WriteLine("\t\tSchema::Table(\"{$table}\")");
			$file->WriteLine("\t\t\t->ID()");
			$file->WriteLine("\t\t\t->Create();");
			$file->WriteLine("\t}");
			$file->WriteLine("");
			$file->WriteLine("\tpublic function Down()");
			$file->WriteLine("\t{");
			$file->WriteLine("\t\tSchema::Table(\"{$table}\")");
			$file->WriteLine("\t\t\t->Drop();");
			$file->WriteLine("\t}");
			$file->WriteLine("}");
			$file->WriteLine("");
			$file->WriteLine("?>");
			$file->Close();

			return Response::Make(200, "Success", array("file" => $filename, "name" => $name, "table" => $table))->ToJSON();
		}
		catch(Exception $ex)
		{
			return Response::Make(405, "Error", $ex->getMessage())->ToJSON();
		}
	}

	public function DestroyAction($parameters)
	{
		try
		{
			$name = "migration_" . $parameters["name"];
			$filename = "{$name}.php";
			$directory = getcwd() . self::MIGRATION_DIRECTORY;

			$itemMigration = MigrationModel::GetQuery()->WhereEqualTo("name", $parameters["name"])->First();

			if($itemMigration)
			{
				FileHandle::Delete($filename, $directory);
				$migration = new MigrationModel($itemMigration["id"]);
				$migration->Delete();
			}

			return Response::Make(200, "Success", array("file" => $filename, "name" => $name))->ToJSON();
		}
		catch(Exception $ex)
		{
			return Response::Make(405, "Error", $ex->getMessage())->ToJSON();
		}
	}

	public function RevertAction($parameters)
	{
		try
		{
			$model = new MigrationModel;
			$itemMigration = $model->GetQuery("migrated")->First();

			if(!$itemMigration) throw new Exception("All migrations have already been reverted");

			$name = "migration_" . $itemMigration["name"];

			if(!class_exists($name)) throw new Exception("The specified migration class does not exist: {$name}");

			$migration = new $name;
			$migration->Down();

			$itemModel = new MigrationModel($itemMigration["id"]);
			$itemModel->Restore();

			return Response::Make(200, "Success", array("name" => $name))->ToJSON();
		}
		catch(Exception $ex)
		{
			return Response::Make(405, "Error", $ex->getMessage())->ToJSON();
		}
	}

	public function ResetAction($parameters)
	{
		try
		{
			$reset = array();
			$model = new MigrationModel;
			$listMigrations = $model->GetQuery("migrated")->Find();

			if(!$listMigrations) throw new Exception("All migrations have already been reverted");

			foreach($listMigrations as $itemMigration)
			{
				$name = "migration_" . $itemMigration["name"];
				$reset[] = $name;

				if(!class_exists($name)) throw new Exception("The specified migration class does not exist : {$name}");

				$migration = new $name;
				$migration->Down();

				$itemModel = new MigrationModel($itemMigration["id"]);
				$itemModel->Restore();
			}

			return Response::Make(200, "Success", array("reset" => $reset))->ToJSON();
		}
		catch(Exception $ex)
		{
			return Response::Make(405, "Error", $ex->getMessage())->ToJSON();
		}
	}

	public function InstallAction($parameters)
	{
		try
		{
			$migration = new migration_install;
			$migration->Up();
			
			return Response::Make(200, "Success", array("installedAt" => date("Y-m-d H:i:s")))->ToJSON();
		}
		catch(Exception $ex)
		{
			return Response::Make(405, "Error", $ex->getMessage())->ToJSON();
		}
	}

	public function UninstallAction($parameters)
	{
		try
		{
			$migration = new migration_install;
			$migration->Down();
			
			return Response::Make(200, "Success", array("uninstalledAt" => date("Y-m-d H:i:s")))->ToJSON();
		}
		catch(Exception $ex)
		{
			return Response::Make(405, "Error", $ex->getMessage())->ToJSON();
		}
	}
}

class MigrationType
{
	const Make = "MAKE";
	const Up = "UP";
	const Down = "DOWN";
}

?>