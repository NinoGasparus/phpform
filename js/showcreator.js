function showcreator(){
    console.log("hello world");
    let creator= document.getElementById('creator');
    if(creator.style.display == 'none'){
    creator.style.display = 'block';
    }else{
        creator.style.display = 'none';
    }
}