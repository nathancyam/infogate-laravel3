@layout('template.main')

@section('content')

<h2>What is Infogate?</h2>

<?php
    $imgGallery = array();
    array_push($imgGallery, array('image'=>'img/carousel-image-library',
                    'label'=>'Learning Materials Everywhere',
                    'caption'=>'A place to find relevant eductional information about your work'));
    array_push($imgGallery, array('image'=>'img/carousel-image-sharing',
                    'label'=>'Get approved information regarding your work',
                    'caption'=>'Learning materials found by your collegues, shared for everyone.'));
    array_push($imgGallery, array('image'=>'img/carousel-image-table',
                    'label'=>'Collaborate and discuss',
                    'caption'=>'A place for students to talk about sources and information'));
    echo Carousel::create($imgGallery, array('style'=>'width: 900px;'));
?>

@endsection
