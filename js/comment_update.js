function arah(cmt_code) {
    let tohide = "c_d_display"+cmt_code;
    let toshow = "c_d_hide"+cmt_code;
    
    if (document.getElementById(tohide).style.display == "block") {
        document.getElementById(tohide).style.display = "none";
        document.getElementById(toshow).style.display = "block";
    }else{
        document.getElementById(tohide).style.display = "block";
        document.getElementById(toshow).style.display = "none";
    }
}