<?php
require_once "base.php";
require_once "function.php";
include "template/header.php";
?>
<div class="container contact-form">
    <div class="row">
        <div class="col-12 col-md-12 bg-light mt-md-3">
            <div class="d-flex justify-content-between align-items-center mt-md-1 mb-md-0">
                <p class="font-weight-bold h2 mb-0 text-primary">Contact</p>
                <div class="p-1">
                    <a href="<?php echo $url; ?>/index.php">
                        <i class="feather-corner-down-left text-primary h2" ></i>
                    </a>
                </div>
            </div>
            <hr>


            <table class="table table-striped table-bordered ">
                <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone No</th>
                    <th>Photo</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach (contacts() as $c){ ?>
                <tr>
                    <td><?php echo $c['id']; ?></td>
                    <td class="text-nowrap"><?php echo short($c['name']); ?></td>
                    <td class="text-nowrap"><?php echo $c['phone']; ?></td>
                    <td>
                        <img src="<?php echo $c['photo']; ?>" style="width: 100px; height: 100px;" alt="">
                    </td>
                    <td class="text-nowrap">
                        <a href="contact_edit.php?id=<?php echo $c['id'];?>" class="btn btn-outline-warning btn-sm">
                            <i class="feather-edit-2 fa-fw"></i>
                        </a>
                        <a href="contact_delete.php?id=<?php echo $c['id'];?>"
                           onclick="return confirm('Are you sure to Delete')" class="btn btn-outline-danger btn-sm">
                            <i class="feather-trash-2 fa-fw"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>









<?php include "template/footer.php";?>
