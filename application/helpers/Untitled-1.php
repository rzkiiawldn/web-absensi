<!-- ====================================[ SLIDE IMAGE  ]====================================== -->
<div id="bannertop">

    <?php
    $live = $this->model_utama->live();
    foreach ($live->result_array() as $row) {
        if (empty($row['link'])) {
            echo " ";
        } else {
            echo "
                <div class='w3-row titlebar'>
                  <h3>Live Now</h3>
                </div>
                <iframe width='100%' height='200px'
                    src='https://www.youtube.com/embed/$row[link]'>
                </iframe>
              ";
        }
    }
    ?>

    <div class="swiper-container">
        <div class="swiper-wrapper">

            <?php
            $headline = $this->model_utama->beritaslidehomeheadline(0, 4);
            foreach ($headline->result_array() as $row) {
                $judul_seo = seo_title($row['judul']);
                $tgl2 = tglberita($row['jam_tampil']);
                if ($row['gambar'] == '') {
                    $foto = 'small_no-image.jpg';
                } else {
                    $foto = "[small]_" . $row['gambar'];
                }
                $datefolder = $this->model_utama->berita_elshinta_image($row['jam_tampil']);
            ?>
                <div class="swiper-slide">
                    <img src="<?php echo base_url(); ?>asset/upload/<?php echo $datefolder; ?>/<?php echo $foto; ?>" alt="<?php echo $row['judul']; ?>">
                    <h4><a href="news/<?php echo $row['id_berita']; ?>/<?php echo $tgl2; ?>/<?php echo $judul_seo; ?>"><?php echo $row['judul']; ?></a></h4>
                </div>
            <?php
            }
            ?>
        </div>
        <!-- Add Pagination 
      <div class="swiper-pagination"></div>
    -->
        <!-- Add Arrows 
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    -->
        <div class="swiper-next">
            <p>&rsaquo;</p>
        </div>
        <div class="swiper-prev">
            <p>&lsaquo;</p>
        </div>

    </div>
</div>
<script>
    var swiper = new Swiper('#bannertop .swiper-container', {
        spaceBetween: 0,
        centeredSlides: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-next',
            prevEl: '.swiper-prev',
        },
    });
</script>

<?php
$banner = $this->model_utama->bannertipe('Mobile Banner 1');
if ($banner->num_rows() == 0) {
?>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- els -->
    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6689996413858797" data-ad-slot="8907672212" data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <?php
} else {
    foreach ($banner->result_array() as $rows) {
    ?>
        <div class="w3-row-padding banner">
            <video style='width: 100%;max-height:400px;' controls autoplay loop>
                <source src="<?php echo $rows['link']; ?>" type="video/mp4">
                <source src="<?php echo $rows['link']; ?>" type="video/ogg">
            </video>
        </div>
<?php
    }
}
?>

<br><br>

<style>
    .grid-container {
        display: grid;
        grid-template-columns: auto auto auto;
        padding: 5px;
    }

    .grid-item {
        border-radius: 10px;
        margin: 3px;
        padding: 10px;
        text-align: center;
    }
</style>

<div class="row widget">
    <div class="container" style="background-color: #dddffd; padding: 5px;">
        <h2 style="text-align: center;">Data Covid-19</h2>
        <?php
        $berita = $this->model_utama->data_covid();
        foreach ($berita->result_array() as $row) {
        ?>

            <h2 style="text-align: center;font-size: 15px;"><?php echo $row['data_global_indo']; ?></h2>

            <div class="grid-container">

                <div class="grid-item" style="background-color: #daa521;">
                    <h3 style="font-size: 12px;">Positif</h3>
                    <p style="font-size: 10px;"><?php echo str_replace(",", ".", number_format($row['positif'])); ?></p>
                    <p style="font-size: 8px;">(<?php echo $row['selisi_positif']; ?>)</p>
                </div>
                <div class="grid-item" style="background-color: #0f9536;">
                    <h3 style="font-size: 12px;">Sembuh</h3>
                    <p style="font-size: 10px;"><?php echo str_replace(",", ".", number_format($row['sembuh'])); ?></p>
                    <p style="font-size: 8px;">(<?php echo $row['selisi_sembuh']; ?>)</p>
                </div>
                <div class="grid-item" style="background-color: #e52a35;">
                    <h3 style="font-size: 12px;">Meninggal</h3>
                    <p style="font-size: 10px;"><?php echo str_replace(",", ".", number_format($row['meninggal'])); ?></p>
                    <p style="font-size: 8px;">(<?php echo $row['selisi_meninggal']; ?>)</p>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>



<script type="text/javascript">
    function number_format(number, decimals, decPoint, thousandsSep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
        var n = !isFinite(+number) ? 0 : +number
        var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
        var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
        var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
        var s = ''

        var toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec)
            return '' + (Math.round(n * k) / k)
                .toFixed(prec)
        }

        // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || ''
            s[1] += new Array(prec - s[1].length + 1).join('0')
        }

        return s.join(dec)
    }
</script>

<!-- TopTen -->

<div class="layoutcontent" id="viral">
    <div class="w3-row">
        <div class="tabs-bar">
            <span>TOP 10 News Weekly</span>
        </div>
    </div>

    <div class="w3-row" style="height: 300px; overflow: auto;">
        <?php
        $berita = $this->model_utama->list_berita_minggu_10_v2();
        foreach ($berita->result_array() as $row) {
            $judul_seo = seo_title($row['judul']);
            $tgl2 = tglberita($row['jam_tampil']);
            $tanggal = jamberita($row['jam_tampil']);
            $url = "news/" . $row['id_berita'] . "/" . $tgl2 . "/" . $judul_seo;

            // if ($row['gambar'] == ''){ $foto = 'small_no-image.jpg'; }else{ $foto = $row['gambar']; }
            // $datefolder = $this->model_utama->berita_elshinta_image($row['jam_tampil']);
        ?>
            <div class="w3-row isicontent">
                <div class="w3-col gambar-l">
                    <img src="<?php echo base_url(); ?>asset/upload/<?php echo $datefolder; ?>/<?php echo $foto; ?>" alt="<?php echo $row['judul']; ?>" />
                </div>
                <div class=" w3-ret info">
                    <div class="date w3-text-white"><?php echo jamberita($row['jam_tampil']); ?> WIB</div>
                    <h4><a href="news/<?php echo $row['id_berita']; ?>/<?php echo $tgl2; ?>/<?php echo $judul_seo; ?>"><?php echo $row['judul']; ?> </a></h4>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<!-- Akhir TopTen -->
<!-- ====================================[ Artikel Top ]====================================== -->
<div class="layoutcontent" id="artikeltop">

    <?php
    $yz = 1;
    $berita = $this->model_utama->beritaslidehomenormal(0, 20);
    foreach ($berita->result_array() as $row) {
        $judul_seo = seo_title($row['judul']);
        $tgl2 = tglberita($row['jam_tampil']);
        if ($row['gambar'] == '') {
            $foto = 'small_no-image.jpg';
        } else {
            $foto = $row['gambar'];
        }
        $datefolder = $this->model_utama->berita_elshinta_image($row['jam_tampil']);
    ?>
        <div class="w3-row isicontent">
            <div class="w3-col gambar-l">
                <img src="<?php echo base_url(); ?>asset/upload/<?php echo $datefolder; ?>/<?php echo $foto; ?>" alt="<?php echo $row['judul']; ?>" />
            </div>
            <div class=" w3-ret info">
                <div class="date"><?php echo jamberita($row['jam_tampil']); ?> WIB</div>
                <h4><a href="news/<?php echo $row['id_berita']; ?>/<?php echo $tgl2; ?>/<?php echo $judul_seo; ?>"><?php echo $row['judul']; ?> </a></h4>
            </div>
        </div>

        <?php
        if ($yz == "5") {
        ?>

            <!-- ====================================[ VIRAL ]====================================== -->
            <div class="layoutcontent" id="viral">
                <?php

                $card = $this->model_utama->beritaviral(0, 1);
                foreach ($card->result_array() as $rowx) {
                    $judul_seox = seo_title($rowx['judul']);
                    if ($rowx['gambar'] == '') {
                        $foto = 'small_no-image.jpg';
                    } else {
                        $foto = $rowx['gambar'];
                    }
                ?>
                    <div class="w3-row">
                        <div class="tabs-bar">
                            <span><a href="indeks/viral"> Viral</a></span>
                        </div>
                        <div class="video">
                            <?php if ($rowx['file'] != '') { ?>

                                <video controls="" preload="none" style="width: 100%;" poster="<?php echo base_url(); ?>asset/upload/foto/<?php echo $foto; ?>">
                                    <source src="<?php echo base_url(); ?>asset/upload/video/<?php echo $rowx['file']; ?>" type="video/mp4">
                                    <source src="<?php echo base_url(); ?>asset/upload/video/<?php echo $rowx['file']; ?>" type="video/webm">
                                    <source src="<?php echo base_url(); ?>asset/upload/video/<?php echo $rowx['file']; ?>" type="video/ogg">

                                    Your browser does not support the video element.
                                </video>
                            <?php } else { ?>
                                <iframe width="100%" height="230px" src="https://www.youtube.com/embed/<?php echo $rowx['link']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                            <?php } ?>
                        </div>
                        <h4>
                            <a href="viral/<?php echo $rowx['id']; ?>/<?php echo $judul_seox; ?>"><?php echo $rowx['judul']; ?></a>
                        </h4>
                    </div>
                <?php
                }
                ?>
            </div>


            <?php
            $banner = $this->model_utama->bannertipe('Mobile Banner 2');
            if ($banner->num_rows() == 0) {
            ?>
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- els -->
                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6689996413858797" data-ad-slot="8907672212" data-ad-format="auto" data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <?php
            } else {
                foreach ($banner->result_array() as $rows) {
                ?>
                    <div class="w3-row-padding banner">
                        <a href="<?php echo $rows['link']; ?>"><img src="<?php echo base_url(); ?>asset/upload/banner/<?php echo $rows['gambar']; ?>" class="w3-image" alt="<?php echo $rows['judul']; ?>"></a>
                    </div>
            <?php
                }
            }
            ?>

            <?php
            $banner = $this->model_utama->bannertipe('Mobile Banner 3');
            if ($banner->num_rows() == 0) {
            ?>

                <?php
            } else {
                foreach ($banner->result_array() as $rows) {
                ?>
                    <div class="w3-row-padding banner">
                        <a href="<?php echo $rows['link']; ?>"><img src="<?php echo base_url(); ?>asset/upload/banner/<?php echo $rows['gambar']; ?>" class="w3-image" alt="<?php echo $rows['judul']; ?>"></a>
                    </div>
            <?php
                }
            }
            ?>


            <?php
            $banner = $this->model_utama->bannertipe('Mobile Banner 4');
            if ($banner->num_rows() == 0) {
            ?>

                <?php
            } else {
                foreach ($banner->result_array() as $rows) {
                ?>
                    <div class="w3-row-padding banner">
                        <a href="<?php echo $rows['link']; ?>"><img src="<?php echo base_url(); ?>asset/upload/banner/<?php echo $rows['gambar']; ?>" class="w3-image" alt="<?php echo $rows['judul']; ?>"></a>
                    </div>
            <?php
                }
            }
            ?>

            <?php
            $banner = $this->model_utama->bannertipe('Mobile Banner 5');
            if ($banner->num_rows() == 0) {
            ?>

                <?php
            } else {
                foreach ($banner->result_array() as $rows) {
                ?>
                    <div class="w3-row-padding banner">
                        <a href="<?php echo base_url(); ?>landing-page/8/salam-semangat-petugas-medis-indonesia"><img src="<?php echo base_url(); ?>asset/upload/banner/banner-salam-semangat-1.jpg" class="w3-image" alt="Salam Semangat Petugas Medis Indonesia"></a>
                    </div>
                    <div class="w3-row-padding banner">
                        <a href="<?php echo $rows['link']; ?>"><img src="<?php echo base_url(); ?>asset/upload/banner/<?php echo $rows['gambar']; ?>" class="w3-image" alt="<?php echo $rows['judul']; ?>"></a>
                    </div>
            <?php
                }
            }
            ?>


            <?php
            $banner = $this->model_utama->bannertipe('Mobile Banner 6');
            if ($banner->num_rows() == 0) {
            ?>

                <?php
            } else {
                foreach ($banner->result_array() as $rows) {
                ?>
                    <div class="w3-row-padding banner">
                        <a href="<?php echo $rows['link']; ?>"><img src="<?php echo base_url(); ?>asset/upload/banner/<?php echo $rows['gambar']; ?>" class="w3-image" alt="<?php echo $rows['judul']; ?>"></a>
                    </div>
            <?php
                }
            }
            ?>



            <?php /*
    <div class="layoutcontent" id="viral" >
      <div class="w3-row">
        <div class="tabs-bar">
          <span><a href="indeks/intim"> Intim</a></span> 
        </div>
        <?php
        $berita = $this->model_utama->beritalipsushome();
        foreach ($berita->result_array() as $row){
          $judul_seo= seo_title($row['judul']);
          $tgl2= tglberita($row['jam_tampil']);
          $tanggal = jamberita($row['jam_tampil']);
          if ($row['gambar'] == ''){ $foto = 'small_no-image.jpg'; }else{ $foto = $row['gambar']; }
        ?>
        <a href="<?php echo base_url().'intim/'.$row['id_berita'].'/'.$judul_seo;?>">
        <div class="w3-display-container" id="intim">
          <img src="<?php echo base_url(); ?>asset/upload/lipsus/<?php echo $foto;?>" style="width:100%" alt="Avatar">
          <div class="w3-display-bottomleft w3-container w3-text-white">
            <p class="w3-large w3-demi" style=""><?php echo $row['judul'];?></p>
          </div>
        </div>
        </a>
        <?php } ?>
      </div>
    </div>

    */ ?>

            <!-- ====================================[ VIRAL ]====================================== -->
        <?php
        } elseif ($yz == "9") {
        ?>
            <!-- ====================================[ FOTO ]====================================== -->
            <div class="layoutcontent" id="viral">
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Responsive -->
                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-4393175438071791" data-ad-slot="8991046939" data-ad-format="auto" data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <?php

                $card = $this->model_utama->beritafoto(0, 1);
                foreach ($card->result_array() as $rowx) {
                    $judul_seo = seo_title($rowx['judul']);
                    if ($rowx['file1'] == '') {
                        $foto = 'small_no-image.jpg';
                    } else {
                        $foto = $rowx['file1'];
                    }
                ?>
                    <div class="w3-row" id="viralfoto">
                        <div class="tabs-bar">
                            <span><a href="indeks/foto"> FOTO</a></span>
                        </div>
                        <h4><a href="foto/<?php echo $rowx['id']; ?>/<?php echo $judul_seo; ?>"><?php echo $rowx['judul']; ?></a></h4>

                        <div class="swiper-container">
                            <div class="swiper-wrapper">

                                <?php if (empty($rowx['caption1'])) {
                                    $gambara = 'elshintaimg.png';
                                } else {
                                    $gambara = $rowx['file1']; ?>
                                    <div class="swiper-slide">
                                        <img src="<?php echo base_url(); ?>asset/upload/foto/<?php echo $gambara; ?>" alt="<?php echo $rowx['judul']; ?>">
                                        <h5><?php echo readmore($rowx['caption1'], 100); ?></a></h5>
                                    </div>
                                <?php } ?>
                                <?php if (empty($rowx['caption2'])) {
                                    $gambara = 'elshintaimg.png';
                                } else {
                                    $gambara = $rowx['file2']; ?>
                                    <div class="swiper-slide">
                                        <img src="<?php echo base_url(); ?>asset/upload/foto/<?php echo $gambara; ?>" alt="<?php echo $rowx['judul']; ?>">
                                        <h5><?php echo readmore($rowx['caption2'], 100); ?></a></h5>
                                    </div>
                                <?php } ?>
                                <?php if (empty($rowx['caption3'])) {
                                    $gambara = 'elshintaimg.png';
                                } else {
                                    $gambara = $rowx['file3']; ?>
                                    <div class="swiper-slide">
                                        <img src="<?php echo base_url(); ?>asset/upload/foto/<?php echo $gambara; ?>" alt="<?php echo $rowx['judul']; ?>">
                                        <h5><?php echo readmore($rowx['caption3'], 100); ?></a></h5>
                                    </div>
                                <?php } ?>

                            </div>
                            <div class="swiper-next">
                                <p>&rsaquo;</p>
                            </div>
                            <div class="swiper-prev">
                                <p>&lsaquo;</p>
                            </div>

                        </div>
                        <script>
                            var swiper = new Swiper('#viralfoto .swiper-container', {
                                spaceBetween: 0,
                                centeredSlides: true,
                                autoplay: {
                                    delay: 4000,
                                    disableOnInteraction: false,
                                },
                                pagination: {
                                    el: '.swiper-pagination',
                                    clickable: true,
                                },
                                navigation: {
                                    nextEl: '.swiper-next',
                                    prevEl: '.swiper-prev',
                                },
                            });
                        </script>

                    </div>
                <?php
                }
                ?>
            </div>
            <!-- ====================================[ FOTO ]====================================== -->
        <?php
        } elseif ($yz == "13") {
        ?>
            <!-- ====================================[ VIDEO ]====================================== -->
            <div class="layoutcontent" id="viral">
                <?php
                $card = $this->model_utama->beritavideo(0, 1);
                foreach ($card->result_array() as $rowx) {
                    $judul_seo = seo_title($rowx['judul']);
                    if ($rowx['gambar'] == '') {
                        $foto = 'small_no-image.jpg';
                    } else {
                        $foto = $rowx['gambar'];
                    }
                ?>
                    <div class="w3-row" id="viralvideo">
                        <div class="tabs-bar">
                            <span><a href="indeks/video"> VIDEO</a></span>
                        </div>
                        <?php if (empty($rowx['gambar'])) {
                            $gambara = 'elshintaimg.png';
                        } else {
                            $gambara = $rowx['gambar'];
                        } ?>
                        <div class="video">
                            <?php if ($rowx['file'] != '') { ?>

                                <video controls="" preload="none" style="width: 100%;" poster="<?php echo base_url(); ?>asset/upload/foto/<?php echo $foto; ?>">
                                    <source src="<?php echo base_url(); ?>asset/upload/video/<?php echo $rowx['file']; ?>" type="video/mp4">
                                    <source src="<?php echo base_url(); ?>asset/upload/video/<?php echo $rowx['file']; ?>" type="video/webm">
                                    <source src="<?php echo base_url(); ?>asset/upload/video/<?php echo $rowx['file']; ?>" type="video/ogg">

                                    Your browser does not support the video element.
                                </video>
                            <?php } else { ?>
                                <iframe width="100%" height="230px" src="https://www.youtube.com/embed/<?php echo $rowx['link']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                            <?php } ?>
                        </div>
                        <h4>
                            <a href="video/<?php echo $rowx['id']; ?>/<?php echo $judul_seo; ?>"><?php echo $rowx['judul']; ?></a>
                        </h4>
                    </div>
                <?php
                }
                ?>
            </div>


            <!-- ====================================[ VIDEO ]====================================== -->
        <?php
        } elseif ($yz == "17") {
        ?>
            <!-- ====================================[ AUDIO ]====================================== -->
            <div class="layoutcontent" id="viral">
                <?php
                $card = $this->model_utama->beritaaudio(0, 1);
                foreach ($card->result_array() as $rowx) {
                    $judul_seo = seo_title($rowx['judul']);
                    if ($rowx['gambar'] == '') {
                        $foto = 'small_no-image.jpg';
                    } else {
                        $foto = $rowx['gambar'];
                    }
                ?>
                    <div class="w3-row">
                        <div class="tabs-bar">
                            <span><a href="indeks/audio"> AUDIO</a></span>
                        </div>
                        <div class="bgaudio">
                            <?php if (empty($rowx['gambar'])) {
                                $gambara = 'elshintaimg.png';
                            } else {
                                $gambara = $rowx['gambar'];
                            } ?>
                            <img src="<?php echo base_url(); ?>asset/upload/foto/<?php echo $gambara; ?>" alt="<?php echo $rowx['judul']; ?>">
                        </div>
                        <div class="audio">
                            <audio controls>
                                <source src="admin/upload/audio/<?php echo $rowx['file']; ?>" type="audio/mp3">
                            </audio>
                        </div>
                        <h4>
                            <a href="audio/<?php echo $rowx['id']; ?>/<?php echo $judul_seo; ?>"><?php echo $rowx['judul']; ?></a>
                        </h4>
                    </div>
                <?php
                }
                ?>
            </div>
            <!-- ====================================[audio ]====================================== -->
        <?php
        }
        ?>
    <?php
        $yz++;
    } //tutup aktual berita terbaru
    ?>
    <div class="w3-center" id="viewmore">
        <a class="w3-button w3-white w3-border w3-els-red-hover w3-round-large" href="indeks">Tampilkan Lagi</a>
    </div>
</div>

<!-- ====================================[ FEATURED ]====================================== -->
<div class="layoutcontent" id="viral">
    <div class="w3-row">
        <div class="tabs-bar">
            <span>FEATURED</span>
        </div>
    </div>

    <div class="w3-row" style="height: 300px; overflow: auto;">
        <?php
        $berita = $this->model_utama->beritaslidehomefeatured(0, 10);
        foreach ($berita->result_array() as $row) {
            $judul_seo = seo_title($row['judul']);
            $tgl2 = tglberita($row['jam_tampil']);
            if ($row['gambar'] == '') {
                $foto = 'small_no-image.jpg';
            } else {
                $foto = $row['gambar'];
            }
            $datefolder = $this->model_utama->berita_elshinta_image($row['jam_tampil']);
        ?>
            <div class="w3-row isicontent">
                <div class="w3-col gambar-l">
                    <img src="<?php echo base_url(); ?>asset/upload/<?php echo $datefolder; ?>/<?php echo $foto; ?>" alt="<?php echo $row['judul']; ?>" />
                </div>
                <div class=" w3-ret info">
                    <div class="date w3-text-white"><?php echo jamberita($row['jam_tampil']); ?> WIB</div>
                    <h4><a href="news/<?php echo $row['id_berita']; ?>/<?php echo $tgl2; ?>/<?php echo $judul_seo; ?>"><?php echo $row['judul']; ?> </a></h4>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>


<!-- ====================================[ 1001 ALASAN NEGERI ]====================================== -->

<div class="w3-row titlebar">
    <a href="indeks/memori">
        <h3>MemoRI</h3>
    </a>
</div>
<?php
$banner = $this->model_utama->bannertipe('MemoRi Banner 2');
if ($banner->num_rows() != 0) {
    foreach ($banner->result_array() as $rows) {
?>
        <div class="w3-row banner" style="margin: 0;">
            <a href="<?php echo $rows['link']; ?>"><img src="<?php echo base_url(); ?>asset/upload/banner/<?php echo $rows['gambar']; ?>" class="w3-image" alt="<?php echo $rows['judul']; ?>"></a>
        </div>
<?php
    }
}
?>


<div class="layoutcontent" id="dalamnegeri">

    <?php
    $alasan = '1001 alasan';
    $berita = $this->model_utama->beritamemoridepan(0, 1);
    foreach ($berita->result_array() as $row) {
        $judul_seo = seo_title($row['judul']);
        $tgl2 = tglberita($row['jam_tampil']);
        $tanggal = jamberita($row['jam_tampil']);
        if (empty($row['gambar'])) {
            $gambarx = 'elshintaimg.png';
        } else {
            $gambarx = $row['gambar'];
        }
        $datefolder = $this->model_utama->berita_elshinta_image($row['jam_tampil']);
    ?>
        <div class="w3-row isicontent">
            <div class="gambar-r w3-right">
                <img src="<?php echo base_url(); ?>asset/upload/<?php echo $datefolder; ?>/<?php echo $gambarx; ?>" alt="<?php echo $row['judul']; ?>" />
            </div>
            <div class="info">
                <div class="date"><?php echo jamberita($row['jam_tampil']); ?> WIB<br>
                    <div class="w3-text-els-blue"><?php echo $row['sub_judul']; ?></div>
                </div>
                <h4><a href="<?php echo base_url() . 'news/' . $row['id_berita'] . '/' . $tgl2 . '/' . $judul_seo; ?>"><?php echo $row['judul']; ?></a></h4>
            </div>
        </div>
    <?php
    }
    ?>

</div>

<!-- ====================================[ EKSPOS ]====================================== -->
<div class="layoutcontent" id="viral">
    <?php
    $berita = $this->model_utama->beritaekspos(0, 1);
    foreach ($berita->result_array() as $row) {
        $judul_seo = seo_title($row['judul']);
        if (empty($row['foto'])) {
            $gambarx = 'elshintaimg.png';
        } else {
            $gambarx = $row['foto'];
        }

    ?>
        <div class="w3-row" style="border-bottom: 1px solid #fff">
            <div class="tabs-bar">
                <span><a href="indeks/ekspos"> EKSPOS</a></span>
            </div>
            <img src="<?php echo base_url(); ?>asset/upload/ekspos/<?php echo $gambarx; ?>" class="w3-image" alt="<?php echo $row['judul']; ?>" />
            <h4>
                <a href="<?php echo base_url() . 'ekspos/' . $row["id"] . '/' . $judul_seo ?>"><?php echo $row['judul']; ?></a>
            </h4>
        </div>
    <?php
    }
    ?>
    <div class="w3-row" style="">
        <?php
        $berita = $this->model_utama->beritaekspos(1, 4);
        foreach ($berita->result_array() as $row) {
            $judul_seo = seo_title($row['judul']);
            if (empty($row['foto'])) {
                $gambarx = 'elshintaimg.png';
            } else {
                $gambarx = $row['foto'];
            }
        ?>
            <div class="w3-row isicontent">
                <div class="w3-col gambar-l">
                    <img src="<?php echo base_url(); ?>asset/upload/ekspos/<?php echo $gambarx; ?>" class="w3-image" alt="<?php echo $row['judul']; ?>" />
                </div>
                <div class=" w3-ret info">
                    <div class="date w3-text-white"><?php echo jamberita($row['created']); ?> WIB</div>
                    <h4><a href="<?php echo base_url() . 'ekspos/' . $row["id"] . '/' . $judul_seo ?>"><?php echo $row['judul']; ?></a></h4>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

</div>

<!-- ====================================[ iklan ]====================================== -->


<!-- ====================================[ Info Dari anda ]====================================== -->
<?php
$ch = curl_init('https://infodarianda.com/rss');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
if (curl_exec($ch) === false) {
    echo '';
} else {
?>
    <div class="w3-row titlebar">
        <h3>Info dari Anda</h3>
    </div>


    <div class="layoutcontent" id="ida">

        <?php
        function bacaURL($url)
        {
            $session = curl_init();
            $useragent = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';

            curl_setopt($session, CURLOPT_USERAGENT, $useragent);
            curl_setopt($session, CURLOPT_URL, $url);
            curl_setopt($session, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($session, CURLOPT_HEADER, false);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, TRUE);
            $hasil = curl_exec($session);
            curl_close($session);
            return $hasil;
        }

        $no = 1;
        $sumber = bacaURL('https://infodarianda.com/rss');
        $sumber = explode('<item>', $sumber);
        foreach ($sumber as $rss) {

            $x = explode('<title>', $rss);
            $x = explode('</title>', $x[1]);
            $title = $x[0];


            $panjang = strlen($title);

            if ($panjang > 1 && $no != 1) {

                $x = explode('<guid>', $rss);
                $x = explode('</guid>', $x[1]);
                $link = $x[0];

                $x = explode('<user>', $rss);
                $x = explode('</user>', $x[1]);
                $user = $x[0];

                $x = explode('<pubDate>', $rss);
                $x = explode('<pubDate>', $x[1]);
                $date = $x[0];

                $x = explode('<pic>', $rss);
                $x = explode('</pic>', $x[1]);
                $image = $x[0];

                if ($image == "ida-logo.png") {
                    $image = "http://infodarianda.com/storage/ida-logo.png";
                } else {
                    $image = "http://infodarianda.com/storage/" . $image;
                }
        ?>
                <div class="w3-row isicontent">
                    <div class="w3-col gambar-l-ida" style="height: 80px; overflow: hidden; border-radius: 50%; min-height: 80px;">
                        <img src="<?php echo $image; ?>" alt="Elshinta" style="width: 100%; min-height: 80px;">
                    </div>
                    <div class="w3-rest info">
                        <div class="date"><?php echo $user; ?></div>
                        <h4><a href="<?php echo $link; ?>"><?php echo $title; ?></a></h4>
                    </div>
                </div>
        <?php
                if ($no >= 6) {
                    break;
                }
            }
            $no++;
        }
        ?>
    </div>
<?php
}
// Close handle
curl_close($ch);
?>
<!-- ====================================[ TOPIK PILIHAN ]====================================== -->

<div class="w3-row titlebar">
    <h3>Topik Pilihan</h3>
</div>

<div class="layoutcontent" id="topik">
    <?php
    $os = array("red", "green");
    $zx = 1;
    $topik = $this->model_utama->topikpilihan(100);
    foreach ($topik->result_array() as $rows) {
        $judul_seo = seo_title($rows['topik']);
        if (in_array($judul_seo, $os)) {
            echo "";
        } else {
            array_push($os, $judul_seo);
            if ($zx > 6) {
                echo "";
            } else {
                $id_topik = $rows['id_topik'];
    ?>
                <div class="topik-pilihan">
                    <div class="kotak">&#9632;</div><a href="topik/<?php echo $rows['id_topik']; ?>/<?php echo $judul_seo; ?>"><?php echo $rows['topik']; ?></a>
                </div>
    <?php $zx++;
            }
        }
    } ?>
</div>

<?php
$banner = $this->model_utama->bannertipe('Mobile Banner 6');
if ($banner->num_rows() == 0) {
?>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- els -->
    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6689996413858797" data-ad-slot="8907672212" data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <?php
} else {
    foreach ($banner->result_array() as $rows) {
    ?>
        <div class="w3-row banner">
            <a href="<?php echo $rows['link']; ?>"><img src="<?php echo base_url(); ?>asset/upload/banner/<?php echo $rows['gambar']; ?>" class="w3-image" alt="<?php echo $rows['judul']; ?>"></a>
        </div>
<?php
    }
}
?>
<!-- ====================================[ Majalah ]====================================== 
<div class="w3-row titlebar">
    <a href="majalah-elshinta"> <h3>Majalah Elshinta</h3></a>
</div>
<div class="layoutcontent" id="emajels" >
    <?php
    $dat = $this->db->query("SELECT id_majels FROM covermajels ORDER BY id_majels desc limit 1");;
    $row = $dat->row();
    $id_majels =  $row->id_majels;
    $record = $this->model_utama->majalah_detail($id_majels);
    foreach ($record->result_array() as $rows) {
    ?>
        <a href="https://docs.google.com/viewerng/viewer?url=<?php echo base_url(); ?>asset/upload/pdf/<?php echo $rows['nama_file']; ?>">
        <img class="w3-image" src="<?php echo base_url(); ?>asset/upload/cover/<?php echo $rows['foto']; ?>" alt="elshinta.com">
        </a>
      <?php } ?>
</div>

<?php
$banner = $this->model_utama->bannertipe('Mobile Banner 7');
if ($banner->num_rows() == 0) {
?>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
els 
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6689996413858797"
     data-ad-slot="8907672212"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
  <?php
} else {
    foreach ($banner->result_array() as $rows) {
    ?>
  <div class="w3-row banner">
    <a href="<?php echo $rows['link']; ?>"><img src="<?php echo base_url(); ?>asset/upload/banner/<?php echo $rows['gambar']; ?>" class="w3-image" alt="<?php echo $rows['judul']; ?>"></a>
  </div>
<?php
    }
}
?>

-->

<!-- ====================================[ SINEKTIKA ]====================================== -->
<div class="w3-row titlebar">
    <a href="indeks/sinektika">
        <h3>Sinektika</h3>
    </a>
</div>

<div class="layoutcontent" id="sinektika">
    <?php
    $berita = $this->model_utama->sinektika(0, 1);
    foreach ($berita->result_array() as $row) {
        $judul_seo = seo_title($row['nama']);
    ?>
        <a href="<?php echo base_url() . 'sinektika/' . $row['id'] . '/' . $judul_seo; ?>" style="text-decoration: none;">
            <div class="w3-row-padding isicontent">
                <div class="w3-col gambar-s">
                    <?php if (empty($row['foto'])) {
                        $gambara = 'elshintaimg.png';
                    } else {
                        $gambara = $row['foto'];
                    } ?>
                    <img src="<?php echo base_url(); ?>asset/upload/sinektika/<?php echo $gambara; ?>" alt="<?php echo $row['judul']; ?>">
                </div>
                <div class="w3-rest info">
                    <h4><?php echo $row['nama']; ?></h4>
                    <div class="date"><?php echo $row['profesi']; ?></div>
                    <div class="desk"><?php readmore($row['opini'], 100); ?></div>
                </div>
            </div>
        </a>
    <?php
    }
    ?>
</div>

<?php
$banner = $this->model_utama->bannertipe('Mobile Banner 8');
if ($banner->num_rows() == 0) {
?>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- els -->
    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6689996413858797" data-ad-slot="8907672212" data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <?php
} else {
    foreach ($banner->result_array() as $rows) {
    ?>
        <div class="w3-row banner">
            <a href="<?php echo $rows['link']; ?>"><img src="<?php echo base_url(); ?>asset/upload/banner/<?php echo $rows['gambar']; ?>" class="w3-image" alt="<?php echo $rows['judul']; ?>"></a>
        </div>
<?php
    }
}
?>

<!-- ====================================[ polling ]====================================== -->
<div class="w3-row titlebar">
    <a href="<?php echo base_url(); ?>indeks/polling">
        <h3>polling</h3>
    </a>
</div>

<div class="layoutcontent" id="polling">

    <div class="polling">

        <?php
        $polling = $this->model_utama->polling(1);
        foreach ($polling->result_array() as $row) {
            $idp = $row['id_polling'];
        ?>
            <div class="polling_top">
                <img src="<?php echo base_url(); ?>asset/upload/polling/<?php echo $row['gambar']; ?>" alt="elshinta" class="w3-image">
                <p><?php echo $row['pilihan']; ?></p>
            </div>


            <div class="polling_middle">

                <?php
                $jumlah = $this->model_utama->polling_jumlah($idp);
                foreach ($jumlah->result_array() as $rowx) {
                    $jml_vote = $rowx['jml_vote'];
                }

                $vote = $this->model_utama->polling_vote($idp);
                foreach ($vote->result_array() as $rowz) {
                    $rating = $rowz['rating'];
                    $prosentase = sprintf("%2.1f", (($rating / $jml_vote) * 100));
                    if ($rating == "0") {
                        $prosentase = 0;
                    }
                ?>
                    <?php
                    $attributes = array('id' => 'formku', 'role' => 'form');
                    echo form_open('polling', $attributes);
                    ?>
                    <div class="polling_row" style="color: #9F005D">
                        <input type="hidden" name="pilihan" value="<?php echo $rowz['pilihan']; ?>">
                        <p><input type="submit" name="submit" value="" class="btn"> <?php echo $rowz['pilihan']; ?></p>
                        <!--<p><button class="btn">&nbsp;</button> Jokowi</p>-->
                        <div class="w3-row">
                            <div class="w3-col w3-right " style="width:40px">
                                <?php
                                $gbr_vote   = $prosentase . "%";
                                ?>
                                <div class="number"><?php echo $prosentase; ?></div>
                            </div>
                            <div class="w3-rest ">
                                <div class="container">
                                    <!--<div class="skills" style="width: 80%; background: #9F005D;">&nbsp;</div>-->
                                    <img src="<?php echo base_url(); ?>template/m.elshinta/images/polinggrafik.png" alt="Elshinta" width="<?php echo $gbr_vote; ?>" height="30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                <?php } ?>

            </div>

            <div class="polling_bottom w3-center">
                <a href="indeks/polling">
                    <div class="w3-button w3-border w3-border-lightgrey w3-round-large">Lihat hasil polling lainya</div>
                </a>
            </div>

        <?php
        }
        ?>
    </div>


</div>
<!-- ====================================[ iklan ]====================================== -->



<!-- ====================================[ BERITA KATEGORI ]====================================== -->
<?php

$botm = $this->model_utama->mainmenukat(0, 3);
foreach ($botm->result_array() as $rowm) {
    $id_tipe = $rowm['id_menu'];
    $nama_tipex = $rowm['nama_menu'];
?>
    <div class="w3-row titlebar">
        <a href="indeks/<?php echo $rowm['link']; ?>">
            <h3><?php echo $nama_tipex; ?></h3>
        </a>
    </div>

    <div class="layoutcontent" id="dalamnegeri">

        <?php
        $berita = $this->model_utama->berita_pertipe($id_tipe, 0, 3);
        foreach ($berita->result_array() as $rowz) {
            $judul_seo = seo_title($rowz['judul']);
            $tgl2 = tglberita($rowz['jam_tampil']);
            if ($rowz['gambar'] == '') {
                $foto = 'small_no-image.jpg';
            } else {
                $foto = $rowz['gambar'];
            }
            $datefolder = $this->model_utama->berita_elshinta_image($rowz['jam_tampil']);
        ?>
            <div class="w3-row isicontent">
                <div class="gambar-r w3-right">
                    <img src="<?php echo base_url(); ?>asset/upload/<?php echo $datefolder; ?>/<?php echo $foto; ?>" alt="<?php echo $rowz['judul']; ?>" />
                </div>
                <div class="info">
                    <div class="date">
                        <div class="w3-text-els-blue w3-left"><?php echo jamberita($rowz['jam_tampil']); ?> WIB</div>
                    </div><br>
                    <h4><a href="news/<?php echo $rowz['id_berita']; ?>/<?php echo $tgl2; ?>/<?php echo $judul_seo; ?>"><?php echo $rowz['judul']; ?></a></h4>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
<?php
} //tutup looping kategori
?>

<?php
$banner = $this->model_utama->bannertipe('Mobile Banner 9');
if ($banner->num_rows() == 0) {
?>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- els -->
    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6689996413858797" data-ad-slot="8907672212" data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <?php
} else {
    foreach ($banner->result_array() as $rows) {
    ?>
        <div class="w3-row banner">
            <a href="<?php echo $rows['link']; ?>"><img src="<?php echo base_url(); ?>asset/upload/banner/<?php echo $rows['gambar']; ?>" class="w3-image" alt="<?php echo $rows['judul']; ?>"></a>
        </div>
<?php
    }
}
?>
<!-- ====================================[ BERITA KATEGORI  CARD ]====================================== -->
<div class="layoutcontent" id="kategori-card">
    <div class="w3-row-padding">

        <?php
        $botm = $this->model_utama->mainmenukat(3, 8);
        foreach ($botm->result_array() as $rowm) {
            $id_tipe = $rowm['id_menu'];
            $nama_tipex = $rowm['nama_menu'];
            if ($nama_tipex != "Multimedia") {
        ?>
                <div class="w3-col s6">
                    <h4 class="header"><?php echo $nama_tipex; ?></h4>
                    <a href="indeks/<?php echo $rowm['link']; ?>">
                        <?php
                        $berita = $this->model_utama->berita_pertipe($id_tipe, 0, 1);
                        foreach ($berita->result_array() as $rowz) {
                            $judul_seo = seo_title($rowz['judul']);
                            $tgl2 = tglberita($rowz['jam_tampil']);
                            if ($rowz['gambar'] == '') {
                                $foto = 'small_no-image.jpg';
                            } else {
                                $foto = $rowz['gambar'];
                            }
                            $datefolder = $this->model_utama->berita_elshinta_image($rowz['jam_tampil']);
                        ?>
                            <div class="w3-border w3-border-lightgrey">
                                <div class="gambar">
                                    <img src="<?php echo base_url(); ?>asset/upload/<?php echo $datefolder; ?>/<?php echo $foto; ?>" alt="<?php echo $rowz['judul']; ?>" class="w3-image" />
                                </div>
                                <div class="desk">
                                    <span><?php echo $rowz['judul']; ?></span>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </a>
                </div>
            <?php
            } else {
            ?>
                <div class="w3-col s6">
                    <h4 class="header"><?php echo $nama_tipex; ?></h4>
                    <a href="indeks/<?php echo $rowm['link']; ?>">
                        <?php
                        $card = $this->model_utama->beritafoto(0, 1);
                        foreach ($card->result_array() as $rowz) {
                            $judul_seo = seo_title($rowz['judul']);
                            if ($rowz['file1'] == '') {
                                $foto = 'small_no-image.jpg';
                            } else {
                                $foto = $rowz['file1'];
                            }
                        ?>
                            <div class="w3-border w3-border-lightgrey">
                                <div class="gambar">
                                    <img src="<?php echo base_url(); ?>asset/upload/foto/<?php echo $foto; ?>" alt="<?php echo $rowz['judul']; ?>" class="w3-image" />
                                </div>
                                <div class="desk">
                                    <span><?php echo $rowz['judul']; ?></span>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </a>
                </div>
        <?php
            }
        }
        ?>

    </div>
</div>

<?php
$banner = $this->model_utama->bannertipe('Mobile Banner 10');
if ($banner->num_rows() == 0) {
?>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- els -->
    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6689996413858797" data-ad-slot="8907672212" data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <?php
} else {
    foreach ($banner->result_array() as $rows) {
    ?>
        <div class="w3-row banner">
            <a href="<?php echo $rows['link']; ?>"><img src="<?php echo base_url(); ?>asset/upload/banner/<?php echo $rows['gambar']; ?>" class="w3-image" alt="<?php echo $rows['judul']; ?>"></a>
        </div>
<?php
    }
}
?>
<!-- ====================================[ MITRA ]====================================== -->
<div id="mitra">

    <div class="swiper-container" style="max-height: 320px;">
        <div class="swiper-wrapper">

            <?php
            $mitra = $this->model_utama->mitra();
            foreach ($mitra->result_array() as $rowm) {
                $idmitra = $rowm['id_mitra'];
                $logo = $rowm['logo'];
            ?>
                <div class="swiper-slide">
                    <div class="w3-row titlemitra">
                        <h3>Aktual dari <img src="<?php echo base_url(); ?>asset/upload/mitra/<?php echo $rowm['logo']; ?>" alt="Elshinta"></h3>
                    </div>

                    <?php
                    $berita = $this->model_utama->berita_permitra($idmitra, 0, 3);
                    foreach ($berita->result_array() as $row) {
                        $tgl2 = tglberita($row['jam_tampil']);
                        $judul_seo = seo_title($row['judul']);
                        if ($row['gambar'] == '') {
                            $foto = 'small_no-image.jpg';
                        } else {
                            $foto = $row['gambar'];
                        }
                        $datecek = date("Y-m-d H:i:s", strtotime($row['jam_tampil']));
                        $dateval = date("Y-m-d H:i:s", strtotime("2020-04-01 00:00:00"));
                        $thn = date("Y", strtotime($row['jam_tampil']));
                        $bln = date("m", strtotime($row['jam_tampil']));
                        if ($datecek > $dateval) {
                            $datefolder = "mitra/" . $thn . '/' . $bln;
                        } else {
                            $datefolder = "mitra/older";
                        }
                    ?>
                        <div class="w3-row isicontent mitra">
                            <div class="w3-col gambar-l">
                                <img src="<?php echo base_url(); ?>asset/upload/<?php echo $datefolder; ?>/<?php echo $foto; ?>" alt="<?php echo $row['judul']; ?>" />
                            </div>
                            <div class=" w3-ret info">
                                <div class="date"><?php echo jamberita($row['jam_tampil']); ?> WIB</div>
                                <h4><a href="news-mitra/<?php echo $row['id']; ?>/<?php echo $tgl2; ?>/<?php echo $judul_seo; ?>"><?php echo $row['judul']; ?></a></h4>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            <?php
            }
            ?>
        </div>
    </div>

</div>
<script>
    var swiper = new Swiper('#mitra .swiper-container');
</script>

<?php
$banner = $this->model_utama->bannertipe('Mobile Banner 11');
if ($banner->num_rows() == 0) {
?>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- els -->
    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6689996413858797" data-ad-slot="8907672212" data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <?php
} else {
    foreach ($banner->result_array() as $rows) {
    ?>
        <div class="w3-row banner">
            <a href="<?php echo $rows['link']; ?>"><img src="<?php echo base_url(); ?>asset/upload/banner/<?php echo $rows['gambar']; ?>" class="w3-image" alt="<?php echo $rows['judul']; ?>"></a>
        </div>
<?php
    }
}
?>
<!-- ====================================[ MEMO DARI KEDOYA ]====================================== -->

<div class="w3-row titlebar">
    <a href="indeks/memo-dari-redaksi">
        <h3>MEMO DARI REDAKSI</h3>
    </a>
</div>

<div class="layoutcontent" id="dalamnegeri">

    <?php
    $kedoya = 'Memo dari Kedoya';
    $berita = $this->model_utama->beritakedoya(0, 3);
    foreach ($berita->result_array() as $row) {
        $judul_seo = seo_title($row['judul']);
        $tgl2 = tglberita($row['jam_tampil']);
        $tanggal = jamberita($row['jam_tampil']);
        if (empty($row['gambar'])) {
            $gambarx = 'elshintaimg.png';
        } else {
            $gambarx = $row['gambar'];
        }
    ?>
        <div class="w3-row isicontent">
            <div class="gambar-r w3-right">
                <img src="<?php echo base_url(); ?>asset/upload/kedoya/<?php echo $gambarx; ?>" alt="<?php echo $row['judul']; ?>" />
            </div>
            <div class="info">
                <div class="date"><?php echo jamberita($row['jam_tampil']); ?> WIB<br>
                    <div class="w3-text-els-blue"><?php echo $row['sub_judul']; ?></div>
                </div>
                <h4><a href="memo-dari-redaksi/<?php echo $row['id_berita']; ?>/<?php echo $judul_seo; ?>"><?php echo $row['judul']; ?></a></h4>
            </div>
        </div>
    <?php
    }
    ?>

</div>

<?php
$banner = $this->model_utama->bannertipe('Horizontal Footer Banner');
if ($banner->num_rows() == 0) {
?>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- els -->
    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6689996413858797" data-ad-slot="8907672212" data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <?php
} else {
    foreach ($banner->result_array() as $rows) {
    ?>
        <div class="w3-row banner">
            <a href="<?php echo $rows['link']; ?>"><img src="<?php echo base_url(); ?>asset/upload/banner/<?php echo $rows['gambar']; ?>" class="w3-image" alt="<?php echo $rows['judul']; ?>"></a>
        </div>
<?php
    }
}
?>

<!-- ====================================[ 1001 ALASAN NEGERI ]====================================== -->

<div class="w3-row titlebar">
    <a href="indeks/alasan-bangga-indonesia">
        <h3>1001 ALASAN BANGGA INDONESIA</h3>
    </a>
</div>

<div class="layoutcontent" id="dalamnegeri">

    <?php
    $alasan = '1001 alasan';
    $berita = $this->model_utama->beritaalasan(0, 3);
    foreach ($berita->result_array() as $row) {
        $judul_seo = seo_title($row['judul']);
        $tgl2 = tglberita($row['jam_tampil']);
        $tanggal = jamberita($row['jam_tampil']);
        if (empty($row['gambar'])) {
            $gambarx = 'elshintaimg.png';
        } else {
            $gambarx = $row['gambar'];
        }
    ?>
        <div class="w3-row isicontent">
            <div class="gambar-r w3-right">
                <img src="<?php echo base_url(); ?>asset/upload/alasan/<?php echo $gambarx; ?>" alt="<?php echo $row['judul']; ?>" />
            </div>
            <div class="info">
                <div class="date"><?php echo jamberita($row['jam_tampil']); ?> WIB<br>
                    <div class="w3-text-els-blue"><?php echo $row['sub_judul']; ?></div>
                </div>
                <h4><a href="alasan-bangga-indonesia/<?php echo $row['id_berita']; ?>/<?php echo $judul_seo; ?>"><?php echo $row['judul']; ?></a></h4>
            </div>
        </div>
    <?php
    }
    ?>

</div>