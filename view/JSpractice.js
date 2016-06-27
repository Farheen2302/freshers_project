
function Complex(a,b)
{
	this.real = a;
	this.imaginary = b;
}

function print(obj)
{
	str = obj.real + ' +i' + obj.imaginary; 
	console.log(str);
	
}
var obj = new Complex(12,15)

print(obj)
