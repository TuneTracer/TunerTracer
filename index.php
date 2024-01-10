<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>TuneTracer</title>
        <script src="https://kit.fontawesome.com/12a41c30dd.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style.css">  
    </head>
    <body>

        <!-- Header Section  -->
        <header>
            <nav class="navbar">
                <div id="navbar" style="padding: 0px;">
                    <div class="navbar-left">
                        <ul>  
                            <li><a href="profil.html" onclick="toggleProfilePage()">
                                <span style="margin-right: 2px;">Profil</span>
                                <i class="fas fa-user-circle"></i>
                            </a></li>   
                            <li id="zenek"><a href="#" style="display: flex; align-items: center; margin-right: 4px;">
                                <span style="margin-right: 3px;">Főmenü</span>
                                <i class="fa fa-solid fa-music"></i>
                            </a></li> 
                            <li id="zenek"><a href="playlist.html" style="display: flex; align-items: center; margin-right: 4px;">
                                <span style="margin-right: 3px;">Lejátszási Listáim</span>
                                <i class="fa-solid fa-bars"></i>
                            </a></li>                                     
                        </ul>
                    </div>
                    <div class="search-container trans-bg">
                        <form class="from1" method="post" id="search-form">
                            <input type="text" class="search-bar" id="searchbar" placeholder="Keresés..">
                            <button type="button" id="search-button"><i class="fa fa-search search-icon"></i></button>
                        </form>
                    </div>

                    <div class="navbar-right">
                        <?php require "isLoggedIn.php"; if(!isLoggedIn()){ echo "<button class='button' style='margin-right: 25px;' onclick='bejelentkezes()'>Bejelentkezés</button>";}else{echo "<button class='button' style='margin-right: 25px;' onclick='kijelentkezes()'>Kijelentkezés</button>";} ?>
                    </div>
                </div>
            </nav>
        </header>       
    
        <!-- Main Section -->

        <main>

            <!-- PlayList side bar -->

            <aside class="aside section-2" style="border-right: 5px solid rgb(17, 17, 102); padding: 12px;">
<h1 class="heading-text inline">Soron következő zenék</h1>
            <div id="search-results"></div>
                <h1 class="heading-text inline" onclick="hidePlaylistItem(event)">Soron következő zenék <i class="toggleIcon fa-solid fa-minus" style="margin-top: 2%; float: right; font-size: 26px; cursor: pointer;"></i></h1>

            <?php
                function getPlaylistSongs() {
                    $servername = "tunetracer.hu";
                    $username = "tunetracer";
                    $password = "tunetracer123321";
                    $dbname = "tunetracer";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT Title, Author, filename, cover_art_file FROM audio";
                    $result = $conn->query($sql);

                    $playlistSongs = array();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $playlistSongs[] = $row;
                        }
                    }

                    $conn->close();

                    return $playlistSongs;
                }
                $playlistSongs = getPlaylistSongs();
            ?>

                <div class="playlist">
                    <?php foreach ($playlistSongs as $index => $song) : ?>
                    <div class="playlist-item" onclick="playSelectedSong('<?php echo $song['Title']; ?>', '<?php echo $song['Author']; ?>', '<?php echo $song['filename']; ?>')">
                        <div class="playlist-content">
                            <div class="content-left">
                                <div style="margin-right: 4px;"><h2><?php echo $index + 1; ?></h2></div>
                                <div class="coverer">
                                    <!-- Corrected the display of cover_art_file -->
                                    <img class="small-img inline-block" src="<?php $song['cover_art_file']; ?>" alt="">
                                </div>
                                <div class="soronzenek">
                                    <div><?php echo $song['Title']; ?></div>
                                    <p><?php echo $song['Author']; ?></p>
                                </div>
                            </div>

                            <div class="content-right">
                                <i class="fa-regular fa-heart" onclick="toggleHeart(this)"></i>
                            </div>                            
                        </div>
                    </div>
<?php endforeach; ?>
                </div>

            </aside>

            <aside class="aside section-1">
                <!-- Podcast Section -->
                <h1 class="heading-text">Podcastok</h1>
                <section class="container">
                    <div class="box">
                        <img src="images/1.jpg" alt="Banner-1">
                    </div>
                    <div class="box" style="z-index: 1;">
                        <img src="images/2.jpg" alt="Banner-3">
                    </div>
                </section>

                <!-- Playlists -->
                <h1 class="heading-text" style="margin-top: 60px;">Lejátszási Listák</h1>
                <section class="latest-releases">
                    <div class="card">
                        <figure>
                            <a href="#">
                                <img src="images/End Game.jpg" alt=""> 
                                <div><i class="fa-solid fa-circle-play" onclick="handleCirclePlay(this)"></i></div>
                            </a>
                            <figcaption class="song-info">
                                <h2>End Game <p>44 zene</p></h2>
                                <div class="heartIcon"><i class="fa-regular fa-heart" onclick="toggleHeart(this)"></i></div>
                            </figcaption>
                         </figure>
                    </div>
                    </div>
                </section>

                <!-- Popular Artists -->
                <section class="popular-artists">
                    <h1 class="heading-text">Népszerű előadók</h1>
                    <div class="popular-artist-content">
                        <figure>
                            <a href="#">
                                <img src="images/End Game.jpg" alt="">
                                <figcaption>Taylor Swift</figcaption>
                            </a>
                        </figure>            
                    </div>

                </section>

                 <!-- Music Station -->

                 <section class="music-station">
                     <figure id="mus-sta-fig">
                         <img src="images/music-station.jpg">
                     </figure>
                     <div class="music-mood">
                        <figure><a href="#"><img src="images/love.jpg" alt=""><p>Love</p></a></figure>
                        <figure><a href="#"><img src="images/retro.jpg" alt=""><p>Retro</p></a></figure>
                        <figure><a href="#"><img src="images/chill.jpg" alt=""><p>Chill</p></a></figure>
                        <figure><a href="#"><img src="images/workout.jpg" alt=""><p>Workout</p></a></figure>
                        <figure><a href="#"><img src="images/rock.jpg" alt=""><p>Rock</p></a></figure>
                        <figure><a href="#"><img src="images/pop.jpg" alt=""><p>Pop</p></a></figure>
                     </div>
                 </section>

                <!-- Latest English -->

                <section class="latest-songs" id="latest-english">
                    <h1 class="heading-text">Legfrissebb Magyar</h1>
                    <div class="latest-song-div">      
                        <figure>
                            <a href="#">
                                <img src="images/End Game.jpg" alt="">
                                <figcaption class="">
                                    <h5>End Game</h5>
                                    <h6>AUG 2, 2020</h6>
                                </figcaption>
                            </a>
                        </figure>       
                    </div>

                </section>

                <!-- Latest Hungarian -->

                <section class="latest-songs" id="latest-hungarian">
                    <h1 class="heading-text">Legfrissebb Magyar</h1>
                    <div class="latest-song-div">
                        <figure>
                            <a href="#">
                                <img src="images/3korty.jpg" alt="">
                                <figcaption class="">
                                    <h5>3korty</h5>
                                    <h6>AUG 2, 2023</h6>
                                </figcaption>
                            </a>
                        </figure>
                    </div>
                </section>
            </aside>
        </main>
        
        <!-- Footer:- Music Player Controls  -->

        <footer>
            <div class="play-song-info trans-bg">
                <div class="con-left trans-bg">
                    <div class="footer-img">
                         
                    </div>
                    <div class="trans-bg">
                        
                    </div> 
                </div>    
                <div class="con-right trans-bg side-margin-4px">
                    <i class="fa-solid fa-ban" style="cursor: pointer;"></i>
                    <i class="fa-regular fa-heart" style="cursor: pointer;" onclick="toggleHeart(this)"></i>
                </div>
            </div>

        <audio id="audioPlayer" controls style="display: none;"></audio>

            <div class="player trans-bg">
                <div class="buttons">
                    <div class="random-track">
                        <i class="fa-solid fa-shuffle" title="random"></i>
                    </div>
                    <div class="prev-track">
                        <i class="fa-solid fa-backward-step"></i>
                    </div>
                    <div class="playpause-track">
                        <i id="playPauseButton" class="fa-solid fa-play" onclick="handlePlayPause()"></i>
                    </div>

                    <div class="next-track">
                        <i class="fa-solid fa-forward-step"></i>
                    </div>
                    <div class="repeat-track">
                        <i class="fa-solid fa-arrow-rotate-right" title="repeat"></i>
                    </div>
                </div>
                <div class="slider_container">
                    <div class="current-time">00:00</div>
                    <input type="range" min="1" max="100" value="0" class="seek_slider">
                    <div class="total-duration">00:00</div>
                </div>
            </div>
            <div class="extras trans-bg">
                <div class="slider_container">
                    <i class="fa fa-volume-down"></i>
                    <input type="range" min="1" max="100" value="99" class="volume_slider">
                    <i class="fa fa-volume-up"></i>
                </div>
                <div></div>
            </div>
        </footer>

        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

        <script>
            function bejelentkezes()
            {
                window.location.href = "regbej.php";
            }

            function kijelentkezes()
            {
                window.location.href = "logout.php";
            }

            function hidePlaylistItem(event) {
                var clickedElement = event.target;

                if (clickedElement.classList.contains("toggleIcon")) {
                    var playlistItem = clickedElement.parentElement.nextElementSibling;
                    var icon = clickedElement;

                    if (icon.classList.contains("fa-minus")) {
                        icon.classList.remove("fa-minus");
                        icon.classList.add("fa-plus");
                        playlistItem.style.display = "none";
                    } else {
                        icon.classList.remove("fa-plus");
                        icon.classList.add("fa-minus");
                        playlistItem.style.display = "block";
                    }
                }
            }

            function toggleHeart(event) {
                if (event.classList.contains("fa-regular")) {
                    event.classList.remove("fa-regular");
                    event.classList.add("fa-solid");
                } else {
                    event.classList.remove("fa-solid");
                    event.classList.add("fa-regular");
                }
            }   

            function handlePlay(event) {
                if (event.classList.contains("fa-play")) {
                    event.classList.remove("fa-play");
                    event.classList.add("fa-pause");
                } else {
                    event.classList.remove("fa-pause");
                    event.classList.add("fa-play");
                }
            }

            function handleCirclePlay(event) {
                if (event.classList.contains("fa-circle-play")) {
                    event.classList.remove("fa-circle-play");
                    event.classList.add("fa-circle-pause");
                } else {
                    event.classList.remove("fa-circle-pause");
                    event.classList.add("fa-circle-play");
                }
            }

            var typingTimer;
            var doneTypingInterval = 100; 

            function performSearch() {
                clearTimeout(typingTimer);
                
                typingTimer = setTimeout(function () {
                    var searchQuery = document.getElementById("searchbar").value.trim();
                    if (searchQuery !== "") {
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "search.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4) {
                                if (xhr.status == 200) {
                                    try {
                                        var results = JSON.parse(xhr.responseText);
                                        updateList(results);
                                    } catch (error) {
                                        console.error("Error parsing JSON:", error.message);
                                        clearList();
                                    }
                                } else {
                                    console.error("Request failed with status:", xhr.status);
                                    clearList();
                                }
                            }
                        };
                        xhr.send("query=" + searchQuery);
                    } else {
                        clearList();
                    }
                }, doneTypingInterval);
            }

            function clearList() {
                var resultList = document.getElementById("search-results");
                resultList.innerHTML = "";
            }

            document.getElementById("searchbar").addEventListener("keyup", performSearch);
            document.getElementById("search-button").addEventListener("click", performSearch);

            function updateList(results) {
                var resultList = document.getElementById("search-results");
                resultList.innerHTML = "";

                if (results && results.length > 0) {
                    var ul = document.createElement("ul");
                    for (var i = 0; i < results.length; i++) {
                        var li = document.createElement("li");
                        li.textContent = results[i].cim + " - " + results[i].szerzo;
                        ul.appendChild(li);
                    }
                    resultList.appendChild(ul);
                }
            }

            function playSelectedSong(title, artist, source) {
                var audioPlayer = document.getElementById('audioPlayer');
                var playPauseButton = document.querySelector('.playpause-track');

                audioPlayer.src = source;

                var songInfo = document.createElement('div');
                songInfo.innerHTML = '<div class="font-mid trans-bg">' + title + '</div><p class="trans-bg">' + artist + '</p>';
                document.querySelector('.footer-img').innerHTML = songInfo.innerHTML;              
            }

            // New function to handle play/pause functionality
            function handlePlayPause() {
                var audioPlayer = document.getElementById('audioPlayer');
                var playPauseButton = document.getElementById('playPauseButton');

                if (audioPlayer.paused) {
                    playPauseButton.classList.remove("fa-play");
                    playPauseButton.classList.add("fa-pause");
                    audioPlayer.play();
                } else {
                    playPauseButton.classList.remove("fa-pause");
                    playPauseButton.classList.add("fa-play");
                    audioPlayer.pause();
                }
            }

        </script>
    </body>
</html>