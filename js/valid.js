function validation(au1, au2){
	if(/[0-9]/.au1.substring(0,1)) {
		console.log("цифра");
	} else if(/[a-zA-Z]/.au1.substring(0,1)) {
		console.log("слово");
	}
}