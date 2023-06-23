<?php
    include("php/database.php");

    if ($_SESSION['user']=="")
    {
        header("location:admin.php");
    }

    $user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/imgs/icon.webp" type="image/x-icon">
    <link rel="stylesheet" href="style/addstyle.css" type="text/css">
    <script src="tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [
                { title: 'My page 1', value: 'https://www.tiny.cloud' },
                { title: 'My page 2', value: 'http://www.moxiecode.com' }
            ],
            image_list: [
                { title: 'My page 1', value: 'https://www.tiny.cloud' },
                { title: 'My page 2', value: 'http://www.moxiecode.com' }
            ],
            image_class_list: [
                { title: 'None', value: '' },
                { title: 'Some class', value: 'class-name' }
            ],
            importcss_append: true,
            file_picker_callback: function (callback, value, meta) {
                /* Provide file and text for the link dialog */
                if (meta.filetype === 'file') {
                callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
                }

                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
                }

                /* Provide alternative source and posted for the media dialog */
                if (meta.filetype === 'media') {
                callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
                }
            },
            templates: [
                    { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table',
            skin: useDarkMode ? 'oxide-dark' : 'oxide',
            content_css: useDarkMode ? 'dark' : 'default',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>
    <title>Add a new post</title>
</head>
<body>
    <div class="nav">
        <a href="dashboard.php"><img src="assets/imgs/icon.webp" alt="Logo" class = "logo"></a>
        <div class="right-links">
        <a href="profile.php">
            <?php
                $query = "SELECT image_url FROM users WHERE username='$user'";
                $result = mysqli_query($conn,$query);
                if ($row = mysqli_fetch_assoc($result))
                    $url = $row["image_url"];
                if ($url == "")
                    { ?>
                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt=<?php echo $user ?> title=<?php echo $user ?> style="width: 30px;height: 30px;display: inline;border: 0;border-radius: 15px;">
                    <?php }
                else { ?>
                <img src=<?php echo $url;?> alt=<?php echo $user ?> title=<?php echo $user ?> style = "width: 30px;height: 30px;display: inline;border: 0;border-radius: 15px;">
                <?php }
            ?>
        </a>
            <a href="php/logout.php" class="logout"><button class='btn'>Log out</button></a>

        </div>
    </div>

<main id = "userform">

    <form action = "php/addpost.php" method="post" class="form-area">
    <h2>Create a new blog post</h2>
    <hr>
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required class = "input" placeholder="Enter the title here!">
    <label for="subtitle">Subtitle:</label>
    <input type="text" id="subtitle" name="subtitle" required class = "input" placeholder="Enter the subtitle here!">
    <label for="banner">Banner's URL:</label>
    <input type="url" id="banner" name="banner" class = "input" placeholder="Enter the banner's URL here!">
    <label for="checkbox">Tags:</label>
    <?php

    $query = "SELECT * FROM categories";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result))
    {
        $cats_id = $row['cats_id'];
        $slug = $row['slug'];
        $name = $row['name'];
    ?>
        <div class="cbox">
            <label for="anime"><?php echo $name;?></label>
            <input type="checkbox" name="tags[]" id="tags" value = <?php echo $cats_id?>>
        </div>
    <?php
    }
    ?>
    <a href="createtags.php" class="conf">
        <button class="btn" type="button">
            Create a new tag!
        </button>
    </a>
    <label for="content">Content:</label>
    <textarea id="content" name="content" rows="4" cols="100" class="input" style="width:100%;resize:none;"></textarea>
    <br>
    <hr>
    <br>
    <div class="conf">
        <button type = "submit" class = "btn">Save</button>
        <a href="dashboard.php"><button type = "button" class = "btn">Cancel</button></a>
    </div>
   
    
</form>

</main>
</body>