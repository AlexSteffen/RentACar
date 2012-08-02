package rentACar;

public class RentACar_Webservice {
	
	public RentACar_Webservice() 
	{
		
	}
	
	public int returnInteger()
	{
		return 10;
	}
	
	public String sayHello(String name)
	{
		return "Hallo " + name;
	}
	
	public Test meinTest(){
		Test t= new Test();
		t.test = "ein test";
		return t;
	}
}
