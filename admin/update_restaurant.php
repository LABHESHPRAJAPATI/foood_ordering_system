               <!DOCTYPE html>
               <html lang="en">
               <?php
                include "include/header.php";
                include "include/menubar.php";




                if (isset($_POST['submit'])) {







                    if (empty($_POST['c_name']) || empty($_POST['res_name']) || $_POST['email'] == '' || $_POST['phone'] == '' || $_POST['url'] == '' || $_POST['o_hr'] == '' || $_POST['c_hr'] == '' || $_POST['o_days'] == '' || $_POST['address'] == '') {
                        $error =     '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>All fields Must be Fillup!</strong>
															</div>';
                    } else {

                        $fname = $_FILES['file']['name'];
                        $temp = $_FILES['file']['tmp_name'];
                        $fsize = $_FILES['file']['size'];
                        $extension = explode('.', $fname);
                        $extension = strtolower(end($extension));
                        $fnew = uniqid() . '.' . $extension;

                        $store = "Res_img/" . basename($fnew);

                        if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif') {
                            if ($fsize >= 1000000) {


                                $error =     '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Max Image Size is 1024kb!</strong> Try different Image.
															</div>';
                            } else {


                                $res_name = $_POST['res_name'];

                                $sql = "update restaurant set c_id='$_POST[c_name]', title='$res_name',email='$_POST[email]',phone='$_POST[phone]',url='$_POST[url]',o_hr='$_POST[o_hr]',c_hr='$_POST[c_hr]',o_days='$_POST[o_days]',address='$_POST[address]',image='$fnew' where rs_id='$_GET[res_upd]' ";
                                mysqli_query($db, $sql);
                                move_uploaded_file($temp, $store);

                                $success =     '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Record Updated!</strong>.
															</div>';
                            }
                        } elseif ($extension == '') {
                            $error =     '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>select image</strong>
															</div>';
                        } else {

                            $error =     '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>invalid extension!</strong>png, jpg, Gif are accepted.
															</div>';
                        }
                    }
                }








                ?>





               <body class="fix-header">
                   <div class="preloader">
                       <svg class="circular" viewBox="25 25 50 50">
                           <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                       </svg>
                   </div>
                   <div id="main-wrapper">






                       <div class="page-wrapper">


                           <div class="row page-titles">
                               <div class="col-md-5 align-self-center">
                                   <h3 class="text-primary">Dashboard</h3>
                               </div>
                           </div>

                           <div class="container-fluid">



                               <?php echo $error;
                                echo $success; ?>




                               <div class="col-lg-12">
                                   <div class="card card-outline-primary">

                                       <h4 class="m-b-0 ">Update Restaurant</h4>

                                       <div class="card-body">
                                           <form action='' method='post' enctype="multipart/form-data">
                                               <div class="form-body">
                                                   <?php $ssql = "select * from restaurant where rs_id='$_GET[res_upd]'";
                                                    $res = mysqli_query($db, $ssql);
                                                    $row = mysqli_fetch_array($res); ?>
                                                   <hr>
                                                   <div class="row p-t-20">
                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label class="control-label">Restaurant Name</label>
                                                               <input type="text" name="res_name" value="<?php echo $row['title'];  ?>" class="form-control" placeholder="John doe">
                                                           </div>
                                                       </div>

                                                       <div class="col-md-6">
                                                           <div class="form-group has-danger">
                                                               <label class="control-label">Bussiness E-mail</label>
                                                               <input type="text" name="email" value="<?php echo $row['email'];  ?>" class="form-control form-control-danger" placeholder="example@gmail.com">
                                                           </div>
                                                       </div>

                                                   </div>

                                                   <div class="row p-t-20">
                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label class="control-label">Phone </label>
                                                               <input type="text" name="phone" class="form-control" value="<?php echo $row['phone'];  ?>" placeholder="1-(555)-555-5555">
                                                           </div>
                                                       </div>

                                                       <div class="col-md-6">
                                                           <div class="form-group has-danger">
                                                               <label class="control-label">website URL</label>
                                                               <input type="text" name="url" class="form-control form-control-danger" value="<?php echo $row['url'];  ?>" placeholder="http://example.com">
                                                           </div>
                                                       </div>

                                                   </div>


                                                   <div class="row">
                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label class="control-label">Open Hours</label>
                                                               <select name="o_hr" class="form-control custom-select" data-placeholder="Choose a Category" >
                                                                   <option >--Select your Hours--</option>
                                                                   <option value="6am">6am</option>
                                                                   <option value="7am">7am</option>
                                                                   <option value="8am">8am</option>
                                                                   <option value="9am">9am</option>
                                                                   <option value="10am">10am</option>
                                                                   <option value="11am">11am</option>
                                                               </select>
                                                           </div>
                                                       </div>


                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label class="control-label">Close Hours</label>
                                                               <select name="c_hr" class="form-control custom-select" data-placeholder="Choose a Category">
                                                                   <option>--Select your Hours--</option>
                                                                   <option value="3pm">3pm</option>
                                                                   <option value="4pm">4pm</option>
                                                                   <option value="5pm">5pm</option>
                                                                   <option value="6pm">6pm</option>
                                                                   <option value="7pm">7pm</option>
                                                                   <option value="8pm">8pm</option>
                                                               </select>
                                                           </div>
                                                       </div>

                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label class="control-label">Open Days</label>
                                                               <select name="o_days" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                                                   <option>--Select your Days--</option>
                                                                   <option value="mon-tue">mon-tue</option>
                                                                   <option value="mon-wed">mon-wed</option>
                                                                   <option value="mon-thu">mon-thu</option>
                                                                   <option value="mon-fri">mon-fri</option>
                                                                   <option value="mon-sat">mon-sat</option>
                                                                   <option value="24hr-x7">24hr-x7</option>
                                                               </select>
                                                           </div>
                                                       </div>



                                                       <div class="col-md-6">
                                                           <div class="form-group has-danger">
                                                               <label class="control-label">Image</label>
                                                               <input type="file" name="file" id="lastName" class="form-control form-control-danger" placeholder="12n">
                                                           </div>
                                                       </div>


                                                       <div class="col-md-12">
                                                           <div class="form-group">
                                                               <label class="control-label">Select Category</label>
                                                               <select name="c_name" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                                                   <option>--Select Category--</option>
                                                                   <?php $ssql = "select * from res_category";
                                                                    $res = mysqli_query($db, $ssql);
                                                                    while ($rows = mysqli_fetch_array($res)) {
                                                                        echo ' <option value="' . $rows['c_id'] . '">' . $rows['c_name'] . '</option>';;
                                                                    }

                                                                    ?>
                                                               </select>
                                                           </div>
                                                       </div>




                                                   </div>

                                                   <h3 class="box-title m-t-40">Restaurant Address</h3>
                                                   <hr>


                                                   <div class="row">
                                                       <div class="col-md-12 ">
                                                           <div class="form-group">

                                                               <textarea name="address" type="text" style="height:100px;" class="form-control"> <?php echo $row['address']; ?> </textarea>
                                                           </div>
                                                       </div>
                                                   </div>


                                               </div>
                                       </div>
                                       <div class="form-actions">
                                           <input type="submit" name="submit" class="btn btn-primary" value="Save">
                                           <a href="all_restaurant.php" class="btn btn-inverse">Cancel</a>
                                       </div>
                                       </form>
                                   </div>
                               </div>
                           </div>
                           <?php include "include/footer.php" ?>
                       </div>

                   </div>


                   </div>

                   </div>



               </body>


               </html>