package rentACar;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

public class RentACar_Webservice {
	
	public RentACar_Webservice() 
	{
		
	}
	
	/*public String sayHello(String name)
	{
		//DataSource.executeNonQuery("INSERT INTO `group` (id, user_id, name) " +
		//		"VALUES (NULL, " + user.getId() + ", '" + name + "')");
		
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
	}*/
	
	/**
	 * Returns all existing locations.
	 * @return Array of locations.
	 */
	public Location[] getAllLocations(){
		
		ArrayList<Location> locations = new ArrayList<Location>();
		
		try {
			ResultSet result = DataSource.executeQuery("SELECT * FROM `locations`");
						
			// create a object from each record and add it to the ArrayList
			while(result.next()) {
				Location location = new Location();
				location.setId(result.getInt("id"));
				location.setCity(result.getString("city"));
				location.setZip(result.getString("zip"));
				location.setStreet(result.getString("street"));
				location.setPhone(result.getString("phone"));
				location.setEmail(result.getString("email"));
				
				locations.add(location);
			}
			
		} catch (ClassNotFoundException e) {
			
		} catch (SQLException e) {

		}
		
		// Convert the ArrayList to an array. This is required because AXIS2 can not transport generic lists over SOAP
		Location[] locationsArray = locations.toArray(new Location[locations.size()]);
		
		return locationsArray;
	}
	
	/**
	 * Returns the locations by the passed id.
	 * @return Array of locations.
	 */
	public Location getLocationById(int id){
		
		try {
			ResultSet result = DataSource.executeQuery("SELECT * FROM `locations` WHERE id=" + id);
						
			// create a object from each record and add it to the ArrayList
			result.first();
			Location location = new Location();
			location.setId(result.getInt("id"));
			location.setCity(result.getString("city"));
			location.setZip(result.getString("zip"));
			location.setStreet(result.getString("street"));
			location.setPhone(result.getString("phone"));
			location.setEmail(result.getString("email"));

			return location;
			
		} catch (ClassNotFoundException e) {
			
		} catch (SQLException e) {

		}
		
		return null;
	}
	
	/**
	 * This webmethod finds all available vehicles to the passed start and return parameters
	 * @param startDate
	 * @param startLocation
	 * @param returnDate
	 * @param returnLocation
	 * @return
	 */
	public Vehicle[] findVehicles(String startDate, int startLocation, String returnDate, int returnLocation){
		ArrayList<Vehicle> vehicles = new ArrayList<Vehicle>();
		
		//Convert the dates
		DateFormat formatter; 
		Date startDateTime = null;
		Date returnDateTime = null;
		
		formatter = new SimpleDateFormat("yy-MM-dd hh:mm:ss");
		try {
			startDateTime = (Date)formatter.parse(startDate);
		
			returnDateTime = (Date)formatter.parse(returnDate);  
		} catch (ParseException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}
		try {
		
			ResultSet result = DataSource.executeQuery("SELECT * FROM `vehicles`");
			
			// Determine number of rows
			//rowCount = result.last() ? result.getRow() : 0;
			//result.first();
			
			// building each contact and add it to the ArrayList
			while(result.next()) {
				Vehicle v = new Vehicle();
				v.setModel(result.getString("manufacturer"));
				v.setOther(startDateTime.toString());
				//v.setImage(inputStreamToString(result.getBinaryStream("image")));
				//v.setBinaryImage(result.getBinaryStream("image"));
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
	
	private String inputStreamToString(InputStream in) 
			throws IOException {
		
		return "";
	}
	/*
	private String inputStreamToString(InputStream in) 
			throws IOException {
		if(in == null)
			return "";
		
		BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(in));
		StringBuilder stringBuilder = new StringBuilder();
		String line = null;

		while ((line = bufferedReader.readLine()) != null) {
		stringBuilder.append(line + "\n");
		}

		bufferedReader.close();
		return stringBuilder.toString();
	}*/
}
