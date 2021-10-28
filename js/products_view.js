$(document).ready(function(){
    $(".fav_icon").click(function(){
        var $rel = $(".pd_fav").attr("rel");  //11(products 테이블의 행 데이터 번호)
        var $dataUserId = $(".pd_fav").attr("data-userid");
        console.log($rel);
        console.log($dataUserId);

        if($dataUserId.length < 1){
            alert("로그인 후 이용 바랍니다.");
            location.href="./login_form.php?spot=productsFav&pdNum="+$rel;
        }else{  //로그인 된 상태
            $.ajax({
                url : './products_fav.php?num='+$rel+'&userid='+$dataUserId,
                dataType : 'json',  //json 파일 형태 {key1:value1, key2:value2, ..}
                type : 'post',
                cache : false,  //캐시 메모리상에 값들을 저장하지 않겠다는 의미(보안 노출 방지역할)
                error : function(){
                    alert("error");
                },
                success : function(data){
                    console.log(data);  //["좋아요 선택", 1]; ==> [좋아요를 선택한 결과를 텍스트로 가져온 값, 실제 여러 사람들이 좋아요를 누른 횟수]
                    if(data[0] == "좋아요 선택"){
                        $(".fav_icon img").attr("src", "./img/fav_fill.svg");
                        $(".pd_fav span").text(data[1]);
                    }else if(data[0] == "좋아요 해제"){
                        $(".fav_icon img").attr("src", "./img/fav_empty.svg");
                        $(".pd_fav span").text(data[1]);
                    }
                }
            });
        }
        return false; 
    });
});