@layout('template.main')

@section('content')

<h2>What is Infogate?</h2>

<?php
    $imgGallery = array();
    $image01 = 'http://laravelinfogate-env-nxfwkz5cpg.elasticbeanstalk.com/img/carousel-image-library.jpg';
    $image02 = 'http://laravelinfogate-env-nxfwkz5cpg.elasticbeanstalk.com/img/carousel-image-sharing.jpg';
    $image03 = 'http://laravelinfogate-env-nxfwkz5cpg.elasticbeanstalk.com/img/carousel-image-table.jpg';
    array_push($imgGallery, array('image'=>$image01,
                    'label'=>'Learning Materials Everywhere',
                    'caption'=>'A place to find relevant eductional information about your work'));
    array_push($imgGallery, array('image'=>$image02,
                    'label'=>'Get approved information regarding your work',
                    'caption'=>'Learning materials found by your collegues, shared for everyone.'));
    array_push($imgGallery, array('image'=>$image03,
                    'label'=>'Collaborate and discuss',
                    'caption'=>'A place for students to talk about sources and information'));
    echo Carousel::create($imgGallery, array('style'=>'width: 900px;'));
?>

@endsection
