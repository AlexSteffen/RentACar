package rentACar;

import java.sql.ResultSet;
import java.sql.SQLException;

public class RentACar_Webservice {
	
	public RentACar_Webservice() 
	{
		
	}
	
	public String sayHello(String name)
	{
		/*DataSource.executeNonQuery("INSERT INTO `group` (id, user_id, name) " +
				"VALUES (NULL, " + user.getId() + ", '" + name + "')");*/
		try {
			ResultSet result = DataSource.executeQuery("SELECT * FROM vehicles");
			
			int rowCount = result.last() ? result.getRow() : 0; // Determine number of rows  
			return "Anzahl " + rowCount;
			
		} catch (ClassNotFoundException e) {
			return "Class not found";
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			return e.getMessage();
		}
		//return "Hallo2 " + name;
	}
	
	public Vehicle getVehicle(){
		Vehicle v = new Vehicle();
		v.setModel("Model Gerrit");
		v.setOther("Other Gerrit");
		v.setNumber(777);
		return v;
	}
}
