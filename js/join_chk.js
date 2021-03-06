function join_chk() {
    
    // 변수에 id로 불러온 값 저장
    let mem_id = document.getElementById("mem_id");
    let mem_pwd = document.getElementById("mem_pwd");
    let mem_cpwd = document.getElementById("mem_cpwd");
    let mem_name = document.getElementById("mem_name");
    let mem_address = document.getElementById("mem_address");
    let mem_phone = document.getElementById("mem_phone");

    if(mem_id.value ==""){
        alert("아이디를 입력하세요");
        mem_id.focus();
        return false;
    }
    let idCheck = /^(?=.*[a-zA-Z])(?=.*[0-9]).{4,25}$/;
    if(!idCheck.test(mem_id.value)){
        alert("아이디는 대소영문자와 숫자로 4자 이상 입력해주세요")
        return false;
    }

    // 비밀번호 정규표현식(영문자+숫자+특수문자 8자리 이상 25자리 이하)
    let pwdCheck = /^(?=.*[a-zA-Z])(?=.*[!@#$%^&*-+])(?=.*[0-9]).{8,25}$/;

    // 비밀번호 유효성 검사
    if (!pwdCheck.test(mem_pwd.value)) {
        alert("비밀번호는 대소영문자와 숫자, 특수문자 조합으로 8~15 자리를 사용해 주세요.")
        mem_pwd.focus();
        return false;
    }

    // 비밀번호 일치 확인
    if (mem_pwd.value != mem_cpwd.value) {
        alert("비밀번호가 일치하지 않습니다.");
        mem_pwd.focus();
        return false;
    }
    if(mem_name.value==""){
        alert("이름을 입력하세요");
        mem_name.focus();
        return false;
    }

    // 이거 숫자+문자가 가능함;;; 모지 정규식 수정 완료. *나 .을 쓰면 안됨 : 숫자만 정규식 ^[0-9]
    // 전화번호 공란 방지
    if (mem_phone.value ==""){
        alert("전화번호를 입력하세요");
        mem_phone.focus();
        return false;
    }
    
    // 전화번호 정규표현식(숫자만 입력)
    let phoneCheck = /^[0-9]{10,11}$/;

    if (!phoneCheck.test(mem_phone.value)) {
        alert("전화번호는 숫자만 입력해 주세요.")
        mem_phone.focus();
        return false;
    }

    if(mem_address.value==""){
        alert("주소를 입력하세요");
        mem_address.focus();
        return false;
    }

    // return false에 모두 걸리지 않으면 여기로 내려와서 입력값 전송.
    alert("가입성공");
    document.join_form.submit();
}