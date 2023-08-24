<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
	if(isset($_POST["submit"]))
	{
		//$created_by = trim($_SESSION["user_id"]);
		$_POST = array_map("trim", $_POST);
        $_POST = array_map("htmlspecialchars", $_POST);
        extract($_POST);
		$error_flag = false;
		
        if($error_flag === false)
		{
			$sql = "INSERT INTO dog_food (food,breed_id) VALUES (:food,:breed_id)";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":food", $food);
			$stmt->bindParam(":breed_id", $breed_id);
		
			if($stmt->execute())
			{
				$_SESSION["success_message"][] = "Successfully created.";
			}
			else
			{
				$_SESSION["error_message"][] = "Failed to create.";
			}
			//$stmt->debugDumpParams();
		}
		echo "<script>window.location='".$_SERVER["PHP_SELF"]."';</script>";
		exit(0);
	}
?>
<div class="container">
	<div class="row">
		<?php require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/view_error_message.php"); ?>
	</div>
	<div class="container col-md-12">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Create Post</div>
					<div class="panel-body">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="breed_id" class="highlight">Dog Breed</label>
                                        <select name="breed_id" id="breed_id"class="form-control" required>
                                            <option value="">Select Dog Breed</option>
                                            <?php if($datas = fetchData(array("table" =>"dog_breed","condition" =>""))):  
                                                $count = 1; foreach($datas as $data):
                                            ?>
                                                    <option value="<?php echo $data["id"]; ?>"><?php echo $data['breed_name']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="food" class="highlight">Food</label>
										<textarea id="food"  rows="6" name="food" class="form-control" autocomplete="off" placeholder="Message"></textarea>
                                    </div>
								</div>
                            </div>
							<button type="submit" name="submit" id="submit" class="btn btn-primary btn-margin btn-width">Add</button>
							<a href="/adapto/admin/user/dashboard" class="btn btn-danger btn-margin btn-width">Clear</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/footer.php");
?>