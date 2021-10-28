<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로그램 리스트</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/products.css">
</head>
<body>
    <header>
        <?php include "./header.php"?>
    </header>    
    <section>
        <div class="subpage">
            <div class="frame">
                <div class="banner_title">
                    <h3>100% <span>Online Course</span></h3>
                    <h1>Get Future's Skill Today!</h1>
                </div>
            </div>
        </div>

        <!--검색바 추가 공간-->
        <div id="search">
            <div class="wrap">
                <form name="search_box" action="./products_search_list.php" method="post">
                    <input type="text" name="searchTxt" placeholder="검색어 입력" autocomplete="off"><button type="button">검색</button>           
                </form>
            </div>
        </div>

        <!--프로그램 리스트-->
        <div id="product_box">
            <h2 id="product_title">프로그램 > 리스트</h2>
            <ul id="product_list">

<?php
    include "./db_con.php";
    $sql = "select * from products order by num desc";
    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result);   //products 라는 db내의 테이블의 데이터로 저장된 행의 개수

    for($i = 0; $i < $total_record; $i++){
        mysqli_data_seek($result, $i);  //각 인덱스 번호($i)에 의한 각 행의 데이터들로 접근한다. => 각 데이터들은 $result마다 담는다.
        $row = mysqli_fetch_array($result);
        $num = $row["num"]; //프로그램 고유의식별 번호를 추적 하여 상세 페이지에서 해당하는 프로그램을 열어주기 위한 도구 products_view.php?num=2
        $title = $row["title"];
        $sub = $row["sub"];
        $price = number_format($row["price"]);
        $fav = number_format($row["fav"]);
        $file_copied = "./products/".$row["file_copied"];
    
?>
                <li onclick="location.href='./products_view.php?num=<?=$num?>'">
                    <div class="pd_img">
                        <div class="img" style="background-image:url(<?=$file_copied?>);"></div>    
                    </div>
                    <h3 class="pd_title"><?=$title?></h3>
                    <p class="pd_sub"><?=$sub?></p>
                    <div class="pd_info">
                        <div class="pd_price"><span><?=$price?></span>원</div>
                        <div class="pd_fav">좋아요&nbsp;<span><?=$fav?></span></div>
                    </div>
                </li>

<?php
    }
?>

            </ul>
<?php
    if($userid){    //로그인 한 사용자만 접근
        if($userlevel < 6){ //레벨값이 6미만인 사용자만 접근 = 판매자

        }
?>
            <ul class="buttons">
                <li><button type="button" onclick="location.href='./products_form.php'">등록하기</button></li>

            </ul>

<?php
        //}
    }
?>
        </div>







    </section>
    <footer>
        <?php include "./footer.php"?>
    </footer>

    <script src="./js/products_search.js"></script>

</body>
</html>