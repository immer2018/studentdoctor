<main class="main-wrapper">


    <section class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pdl">
                    <div class="tab-wrapper row">
                        <div class="col-md-4 pull-right">
                            <div class="recentpostList">
                                <h3>Recent Post</h3>
                                <ul>
                                    <?php foreach ($recent_post as $row){?>
                                        <li>
                                            <img src="<?php echo base_url('assets/file/blog/'.$row->primary_image);?>" class="img-responsive recentpostimg">
                                            <a href="#"><?php echo $row->title; ?></a>
                                            <span class="pull-right"><?php echo $row->date; ?></span>
                                        </li>
                                    <?php }?>
                                </ul>
                            </div>

                            <div class="post-cat">
                                <h3>Post Category</h3>
                                <ul>
                                    <?php foreach ($blog_category as $row){?>
                                        <li>
                                            <a href="#"><?php echo $row->cat_type; ?></a>
                                        </li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>

                        <!-- Tab panes -->
                        <div class="content col-md-8">
                            <?php if(count($allblog)<=0){?>
                                <div class="alert alert-info">No Blogs</div>
                            <?php }else{?>

                                <?php if(!empty($allblog)) {

                                    foreach ($allblog as $row)
                                    { ?>

                                        <!-- Content -->
                                        <div class="content col-md-12">
                                            <!-- Post -->
                                            <div class="post">
                                                <h2><?php echo $row->title; ?></h2>
                                                <div class="post-image">
                                                    <img src="<?php echo base_url() . 'assets/file/blog/' .$row->primary_image; ?>" class="img-responsive" width="100%" alt="">
                                                </div>
                                                <div class="row">
                                                    <ul class="post-meta">
                                                        <li><span>Added:</span><?php echo date("d-m-Y", strtotime($row->date)); ?></li>
                                                        <li><span>Author:</span>Admin</li>
                                                        <li><span>Tags:</span><?php echo $row->tag;?></a></li>
                                                    </ul>
                                                    <div class="post-content">
                                                        <div class="two-line-div">
                                                            <p class="" max-lenght="200">
                                                                <?php
                                                                $link = base_url('blog/Postlist/singlepost/' . $row->id);
                                                                $string = strip_tags($row->description);

                                                                if (strlen($string) > 440) {

                                                                    // truncate string
                                                                    $stringCut = substr($string, 0, 440);

                                                                    // make sure it ends in a word so assassinate doesn't become ass...
                                                                    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...<a href="'.$link.'" class="btn btn-filled btn-info">Read more</a>';
                                                                }
                                                                echo $string;
                                                                ?>
                                                                <?php //echo substr($row->description, 0, 300); ?>
                                                            </p>

                                                        </div>
                                                        <div class="visible-sm visible-xs">
                                                        <a href="<?php echo base_url('blog/Postlist/singlepost/' . $row->id); ?>" class="btn btn-filled mt-20 btn-info">Read more</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Post -->
                                        </div>
                                        <?php
                                    }

                                }

                            }

                            ?>

                        </div>

                </div>

            </div>



        </div><!--container-->
    </section>

</main>









<style type="text/css">
	.post{
		width: 100%;
	}

    .mt-20{
        margin-top: 20px;
    }
	

	.two-line-div{
		overflow: hidden;
        margin-top: 5px;
        text-align: justify;
	}

	p.lead{
		font-size: 16px;
		margin-bottom: 30px;
		margin-right: 56px;

		/* BOTH of the following are required for text-overflow */
	}

	.line-clamp
	{
		display            : block;
		display            : -webkit-box;
		-webkit-box-orient : vertical;
		position           : relative;

		line-height        : 1.2;
		overflow           : hidden;
		text-overflow      : ellipsis;
		padding            : 0 !important;
	}
	.line-clamp:after
	{
		content    : ' ';
		text-align : right;
		bottom     : 0;
		right      : 0;
		width      : 25%;
		display    : block;
		position   : absolute;
		height     : calc(1em * 1.2);
		/*		background : linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1) 75%);
        */	}
	@supports (-webkit-line-clamp: 1)
	{
		.line-clamp:after
		{
			display : none !important;
		}
	}
	.line-clamp-1
	{
		-webkit-line-clamp : 1;
		height             : calc(1em * 1.2 * 1);
	}
	.line-clamp-2
	{
		-webkit-line-clamp : 2;
		height             : calc(1em * 1.2 * 2);
	}
	.line-clamp-3
	{
		-webkit-line-clamp : 3;
		height             : calc(1em * 1.2 * 3);
	}
	.line-clamp-4
	{
		-webkit-line-clamp : 4;
		height             : calc(1em * 1.2 * 4);
	}
	.line-clamp-5
	{
		-webkit-line-clamp : 5;
		height             : calc(1em * 1.2 * 5);
	}
	/* End required CSS. */


	@media only screen and (max-width: 600px){
		.post{
			width: 100%;
		}

		.two-line-div{
			max-height: 155px !important;
			overflow: hidden;
		}

        .mt-20{
            margin-top: 0;
        }

	}

    .recentpostimg{
        float: left;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
        margin-top: -2px;
    }
    .recentpostList{
        float: left;
        margin-bottom: 20px;
    }
    .recentpostList ul{
        float: left;
    }

    .recentpostList li {
        float: left;
        display: block;
        margin: 10px auto;
    }

    .recentpostList li a{
        width: 100%;
        font-size: 15px;
        font-weight: lighter;
        color: #113058;
    }

    .post-cat{
        float: left;
    }
    .post-cat ul{
        float: left;
    }
    .post-cat ul li{
        float: left;
        display: inline-block;
        margin-right: 5px;
    }
    .post-cat ul li a{
        float: left;
        display: inline;
        padding: .2em .6em .3em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
        height: auto;
        width: auto;
        padding: 5px;
        background: #113058;
    }


</style>
