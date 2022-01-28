# bookstore

## 1. 목적: mySQL 및 PHP CRUD를 활용하여 책을 주제로 웹 만들기
<hr>
<br>

### 2. 구현 기능 
|    **일반회원**    |   **관리자**     |
|:-------------:|:-------------:|
|도서검색|도서관리|
|도서추천|거래처(출판사)관리|
|커뮤니티(게시판,쪽지)|작가정보관리|
|구매시스템|구매접수내역관리|
|로그인|공지사항|

<br>

### 3. 작업순서
+ view 페이지 Figma툴 이용 prototype 제작 
+ prototype에 따른 테이블 구조 e-r diagram화 
+ 페이지 제작 및 단계별 기능 작동 확인
<br>

---

--- 2022-01-26 --- <br>
DB 및 테이블 생성.
index 페이지 제작. 
<br>

--- 2022-01-27 --- <br>
로그인 및 회원가입 구현. (아이디 중복체크 js 오류로 보류중🤢)
<br>

--- 2022-01-28 --- <br>
author, publisher, book 테이블 import csv 데이터 제작. book table은 foreign key 업데이트 오류중..😂 
<br>
+
회원정보 수정 및 로그인 성공시 이동되는 mypage.php 구현. <br>
회원정보 수정 시 비밀번호 체크를 위하여 비밀번호 수정은 따로 빼서 처리함.
현재 창 넘어가는데 모달 처리 가능하면 .... 그게 나을듯....?
