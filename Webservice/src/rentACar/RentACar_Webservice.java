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
	
	public void meinTest(){
		//return t;
	}
	
	public Vehicle hey(){
		Vehicle v = new Vehicle();
		v.model = "sasa";
		v.other = "sdssd";
		return v;
	}
}
