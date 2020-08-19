function change(event){
		var a = document.getElementsByClassName('icon1');
		var x = document.getElementsByTagName("BODY")[0];
		var y = document.getElementsByClassName("container");
		var z = document.getElementsByClassName("jumbotron");
		var w =document.getElementsByTagName('h3');
		for(var i=0;i<a.length;i++){
			if(a[i].classList.remove("hide"));
		}
		for(var j=0;j<w.length;j++){
			w[j].classList.toggle("aqua");
		}
		event.target.classList.toggle("hide");
		x.classList.toggle("bg-dark");
		y[0].classList.toggle("text-white");
		z[0].classList.toggle("bg-info");
}