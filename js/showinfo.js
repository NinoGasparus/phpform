function showinfo(){
    console.log("hello world");
    if(document.getElementById('infopane').style.display == 'flex'){
        document.getElementById('infopane').style.display = 'none';
    }else{
        document.getElementById('infopane').style.display = 'flex';
    }
}