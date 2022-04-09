<?php
    session_start();
    $page_title = "Home";
    require "includes/header.php";
?>

<?php require "includes/nav.php"; ?>



<section class="main">
    <div class="container">
        <h1>Github Guide</h1>
        <p>Read our blog about Github. And how it can help your developer career.</p>
        <img src="../assets/Images/github-logo.jpg" class="showcase-img" alt="github-logo.jpg">
    </div>
</section>

<div class="container">
    <section class="main">
        <h1>What is GitHub? What is Git? And How to Use These Developer Tools.</h1>
        <p>The first programs you write will probably not be very impressive. You'll make lots of mistakes and you'll never want to revisit the past.</p>
        <p>But soon enough, you'll be writing large, complex programs. Maybe you'll delete some stuff now that you want to bring back later. Or maybe you'll
            bring in a friend to help, and want to gracefully add their changes to your program while you continue to work on your parts.
        </p>
        <p>That's where version control comes in, and it's a skill that any employer will expect you to have mastered. It's also extremely useful for anyone
            working on anything that is saved in pieces - from a computer program to a recipe to a novel.
        </p>
        <p>The first thing you'll want to do are install git. <a href="https://git-scm.com/downloads" target="1">Click here to install git.</a></p> 
        <p>Once you've done that, create a GitHub account<a href="https://Github.com"  target="1"> here.</a></p>   
        <h1>What is version control?</h1>
        <p>Version control refers to the ability to save your place in a document or folder and reference previous saves.</p>
        <h1>What is Git?</h1>
        <p>Git is a version control system developed by Linus Torvalds in 2005 (the same guy who wrote Linux). Git helps developers keep track of the state
            of their code and allows collaboration on a codebase. We'll go over the main components a little later.
        </p>  
        <p>Git is a version-control system for tracking changes in computer files and coordinating work on those files among multiple people. Git is a
            Distributed Version Control System. So Git does not necessarily rely on a central server to store all the versions of a project’s files.
            Instead, every user “clones” a copy of a repository (a collection of files) and has the full history of the project on their own hard drive.
            This clone has all of the metadata of the original while the original itself is stored on a self-hosted server or a third party hosting service
            like GitHub.
        </p> 
    </section>
</div>
<div class="container">
    <section class="showcase-images">
        <section class="showcase-image">
            <img src="../assets/Images/machine-learning.jpg" alt="" class="images">
            <img src="../assets/Images/laptop.jpg" alt="" class="images">
        </section>
        <section class="showcase-image">
            <img src="../assets/Images/code.jpg" alt="" class="images">
            <img src="../assets/Images/coding.jpg" alt="" class="images">
        </section>
    </section>
</div>

<?php require "includes/footer.php"; ?>