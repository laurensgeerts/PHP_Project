<?php
    include_once 'classes/db.class.php';
    include 'classes/post.class.php';
    include_once 'classes/user.class.php';

    $post = new Post();
    $user = new User();
        $start = $_POST['start'];
        $end = $_POST['end'];
        $ids = $_POST['ids'];

        try {
            $posts = Post::getAll($ids, $start, $end);
            //echo $ids, $start, $end, '   ';
            $html = '';

            foreach ($posts as $post):
            $time_post = $post->date_created;
            $time_post_str = strtotime($time_post);

            //echo $post->picture; //wordt niet gevonden
            //echo $post->$convertedTime; //wordt niet gevonden
            //echo $time_post_str;

            $html .= '<div class="post">';
            $html .= '<article >';
            $html .= '<img src="data/uploads/303.png">';
            $html .= '<p>'.$post->firstname.' '.$post->lastname.'</p>';
            $html .= '<p>'.$convertedTime = Post::timeConverter($time_post_str).'</p>';
            $html .= '<img src="data/uploads/303.png" alt="" href="detail.php?id='.$post->id.'">';
            $html .= '<p> '.$post->description.'</p>';
            $html .= '</article>';
            $html .= '</div>';
            endforeach;
        } catch (Exception $e) {
            $error = $e->getMessage();
            $html = '<li class="post">';
            $html .= '<p>'.$error.'</p>';
            $html .= '</li>';
        }
        echo $html;
