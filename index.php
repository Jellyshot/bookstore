
<?php
    require './utility/nav.php';
?>
<div class="search-container">
    <form action="./book/book_searchResult.php" method="POST" class="search_box">
        <select name="s_ctg">
            <option value="book_name">책이름</option>
            <option value="aut_name">작가명</option>
            <option value="pbs_name">출판사명</option>
        </select>
        <input type="text" placeholder="검색어를 입력하세요" name="search">
        <input type="submit" value="&#xf002;"/>
    </form>
</div>

<!-- 배경화면 -->
<div class="custom-shape-divider-bottom-1643186456">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M1200,0H0V120H281.94C572.9,116.24,602.45,3.86,602.45,3.86h0S632,116.24,923,120h277Z" class="shape-fill"></path>
    </svg>
</div>
</body>
</html>






