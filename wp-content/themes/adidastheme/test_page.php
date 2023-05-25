<?php

/**
 * Template Name: Test Page

 */

global $wpdb;
$tablename = $wpdb->prefix . 'post_job';
if (isset($_POST['submit'])) {


    $data = array(
        'title' => $_POST['title']
    );

    $wpdb->insert($tablename, $data);
}

$results = $wpdb->get_results("SELECT * FROM $tablename ");


// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header(); ?>


<div class="container">
    <div class="row">
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form action="" id="postjob" method="post">
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" />
                </div>
                <button type="submit" name="submit" class="btn btn-primary mb-3">Submit</button>
            </form>
            <div class="table-responsive mt-5">
                <table class="table table-responsive table-bordered text-white">
                    <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($results as $key => $result) { ?>

                            <tr>
                                <td class="w-25"><?php echo $key + 1; ?></td>
                                <td><?php echo $result->title; ?></td>
                            </tr>

                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>