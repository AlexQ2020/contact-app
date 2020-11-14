<?php
session_start();
require_once "base.php";
require_once "function.php";
include "template/header.php";


?>

<div class="container contact-form">
    <div class="row">
        <div class="col-12 col-md-4 m-auto">
            <div class="my-5">

                <div class="contactForm">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-weight-bold text-uppercase">
                                Update contact
                            </h4>
                            <hr>
                            <?php
                            $id=$_GET['id'];
                            $current=contact($id);

                            if(isset($_POST['updateContact'])){

                                contactUpdate();


                            }

                            ?>

                            <form method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <div class="form-group">
                                    <label for="fname" class="text-primary font-weight-bold">First Name</label>
                                    <input type="text" id="fname" name="fname" class="form-control" value="<?php echo $current['fname']; ?>">
                                    <?php if(getError('fname')){ ?>
                                        <small class="text-danger font-weight-bold"><?php echo getError('fname'); ?></small>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="lname" class="text-primary font-weight-bold">Last Name</label>
                                    <input type="text" id="lname" name="lname" class="form-control" value="<?php echo $current['lname']; ?>">
                                    <?php if(getError('lname')){ ?>
                                        <small class="text-danger font-weight-bold"><?php echo getError('lname'); ?></small>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="text-primary font-weight-bold">Ph Number</label>
                                    <input type="text" id="phone" name="phone" class="form-control" value="<?php echo $current['phone']; ?>">
                                    <?php if(getError('phone')){ ?>
                                        <small class="text-danger font-weight-bold"><?php echo getError('phone'); ?></small>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="upload" class="text-primary font-weight-bold">Upload Photo</label>
                                    <input type="file" id="upload" name="upload" class="form-control p-1" value="<?php echo $current['upload']; ?>">
                                    <?php if(getError('upload')){ ?>
                                        <small class="text-danger font-weight-bold"><?php echo getError('upload'); ?></small>
                                    <?php } ?>
                                </div>

                                <hr>
                                <div class="form-row justify-content-end align-items-center">
                                    <button name="updateContact" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php clearError(); ?>
<?php include "template/footer.php"; ?>

