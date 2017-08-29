
<link href="<?php echo base_url('assets/datatable/dataTables.bootstrap.css');?>" rel="stylesheet">

<div class="content-wrapper">

    <section class="content-header">
        <h1>
           FORUM
            <small>Board</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">FORUM</a></li>
            <li class="active">Board</li>
        </ol>
    </section>
    <section class="content">
        
        
        
        
        
        
        <div class="row">
            <?php if($this->session->flashdata('message')){ ?>
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong> New Forum Post Create Successfully</strong>
                    </div>
                </div>
            <?php } ?>
            <!-- /.GREEN BOX SAJIB -->


            <!-- /.MENU FORUM SAJIB -->
            <div class="col-md-12">
                <div class="box box-default box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Forum Board</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">



                        <div class="col-md-2 text-center">
                            <a  href="<?php echo base_url('forum/forum/index'); ?>" class="btn "><i class="fa fa-home"></i> Forum Home</a>

                        </div>




                        <div class="col-md-2 text-center">
                            <a data-toggle="modal" href="<?php echo base_url('forum/forum/addcat'); ?>" class="btn "><i class="fa fa-plus"></i> Add New Category</a>

                        </div>


                        <div class="col-md-2 text-center">
                            <a  href="<?php echo base_url('forum/forum/allmypostlist'); ?>" class="btn "><i class="fa fa-list"></i> All My Post</a>

                        </div>


                        <div class="col-md-2 text-center">
                            <a  href="<?php echo base_url('forum/forum/allmycomments'); ?>" class="btn"><i class="fa fa-user"></i> My Comments Post</a>

                        </div>



                        <div class="col-md-2 text-center">

                            <a  href="<?php echo base_url('forum/forum/index'); ?>" class="btn"><i class="fa fa-backward"></i> Go Back Forum</a>

                        </div>

                        <div class="col-md-2 text-center">
                            <a data-toggle="modal" href="#myModal" class="btn btn-danger"><i class="fa fa-plus"></i> Add New Topic</a>

                        </div>




                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <!-- /.MENU FORUM SAJIB -->



            <!-- /.Orage BOX SAJIB -->
        <div class="col-md-12">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">General Topic Discussion</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
              <table class="table table-bordered">
                  <tbody>
                  <tr>
                      <th> <div class="col-md-2 pull-left">
                              <a data-toggle="modal" href="#myModal" class="btn btn-info"><i class="fa fa-plus"></i> Add New Topic</a>

                          </div></th>


                  </tr>

                  </tbody>

              </table>
            <!-- /.box-header -->
            <div class="box-body">

              
                <table class="table table-striped">
                <tbody>
                <tr>
                  <th style="width: 100px">#</th>
                  <th>Topic</th>
                    <th style="width: 100px"> Author</th>
                  <th style="width: 100px"> Replies</th>
                  <th style="width: 140px"> Views </th>
                  <th style="width: 140px"> Last post  </th>
                  <th style="width: 140px"> Reply  </th>
                </tr>

            <?php if (is_array($postdeatils)) {
                foreach ($postdeatils as $row) {
                    ?>
                    <tr>
                        <td><i class="fa fa-fw fa-bell-o"></i></td>
                        <td>     <?php echo $row->title; ?></td>
                        <td>
                            <?php echo $row->author_id; ?>
                        </td>
                        <td>
                            <?php echo $row->views; ?>
                        </td>
                        <td><?php echo $row->reply; ?></td>
                        <td><?php echo $row->datetime; ?></td>
                        <td>
                            <a class="btn  btn-primary" href="<?php echo base_url('Forum/forum/discuss/' . $row->post_id); ?>">  Reply</a>

                        </td>
                    </tr>
                <?php
                } }
                ?>
                
              </tbody></table>
                
                
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>    
             <!-- /.Orage BOX SAJIB -->
            
             
            
            
    
        </div>
    </section>
</div>



<div aria-hidden="true" aria-labelledby="myModal" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">New Topic</h4>
            </div>

            <form role="form" method="post" id="post" enctype="multipart/form-data"
                  action="<?php echo base_url('Forum/forum/listcat/' . $getid); ?>">

            <div class="modal-body">
                <input name="hiddencat" value="<?php echo $getid; ?>" type="hidden" class="form-control">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Topic Title<span class="error">*</span></label><span id="title-error" class="error" for="title"></span>
                        <input name="title" value="" class="form-control" required="">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Topic Deatils<span class="error">*</span></label><span id="title-error" class="error" for="title"></span>

                        <textarea name="deatils" value="" class="form-control"></textarea>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Attachment<span class="error">*</span></label><span id="title-error" class="error" for="title"></span>

                        <input class="btn btn-default" name="attachment" type="file">
                    </div>
                </div>


            </div>

            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-danger" type="button">Cancel</button>
                <input type="submit" name="submit" class="btn  btn-success" value="Save">
            </div>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript">


    $(function() {
        $("#post").validate({
            rules: {
                title: {
                    required:true
                },
                deatils: {
                    required:true
                }

            },
            messages: {
                title: {
                    required: "Post title is Required",}
            },

            title: {
                deatils: "Post deatils is Required",}
              }
        });

    });


</script>

