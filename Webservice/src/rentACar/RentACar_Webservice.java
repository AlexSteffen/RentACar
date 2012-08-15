package rentACar;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

public class RentACar_Webservice {
	
	public RentACar_Webservice() 
	{
		
	}
	
	public String sayHello(String name)
	{
		/*DataSource.executeNonQuery("INSERT INTO `group` (id, user_id, name) " +
				"VALUES (NULL, " + user.getId() + ", '" + name + "')");*/
		int rowCount=0;
		try {
			ResultSet result = DataSource.executeQuery("SELECT * FROM vehicles");
			
			rowCount = result.last() ? result.getRow() : 0; // Determine number of rows  
			return "Anzahl " + rowCount + ", Name: "+ name;
			
		} catch (ClassNotFoundException e) {
			return "Class not found";
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			return e.getMessage();
		}
		//return "Hallo2 " + name;
	}
	
	public Vehicle[] findVehicles(String a){
		ArrayList<Vehicle> vehicles = new ArrayList<Vehicle>();
		int rowCount=0;

		try {
		
			ResultSet result = DataSource.executeQuery("SELECT * FROM `vehicles`");
			
			// Determine number of rows
			//rowCount = result.last() ? result.getRow() : 0;
			//result.first();
			
			// building each contact and add it to the ArrayList
			while(result.next()) {
				Vehicle v = new Vehicle();
				v.setModel(result.getString("manufacturer"));
				
				vehicles.add(v);
			}
			
		} catch (ClassNotFoundException e) {
			
		} catch (SQLException e) {

		}
		
		Vehicle[] vehiclesArray = (Vehicle[])vehicles.toArray(new Vehicle[vehicles.size()]);
		
		return vehiclesArray;
		
	}
	
	public Vehicle getVehicle(int id){

		Vehicle v = new Vehicle();
		v.setModel("Model Gerrit");
		v.setOther("Other Gerrit");
		v.setNumber(777);
		
		return v;
	}
}
