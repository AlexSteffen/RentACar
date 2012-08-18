package rentACar;

import java.io.IOException;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

import org.apache.commons.io.IOUtils;


public class RentACar_Webservice {
	
	public RentACar_Webservice() 
	{
		
	}
	
	/**
	 * Returns all existing locations.
	 * @return Array of locations.
	 */
	public Location[] getAllLocations(){
		
		ArrayList<Location> locations = new ArrayList<Location>();
		
		try {
			ResultSet result = DataSource.executeQuery("SELECT * FROM locations");
						
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
			ResultSet result = DataSource.executeQuery("SELECT * FROM locations WHERE id=" + id);
						
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
		
			ResultSet result = DataSource.executeQuery("SELECT * FROM vehicles");
			
			// building each contact and add it to the ArrayList
			while(result.next()) {
				Vehicle vehicle = new Vehicle();
				
				vehicle.setId(result.getInt("id"));
				vehicle.setManufacturer(result.getString("manufacturer"));
				vehicle.setModel(result.getString("model"));
				vehicle.setColor(result.getString("color"));
				vehicle.setEngineType(result.getString("engine_type"));
				vehicle.setEngineSize(result.getDouble("engine_size"));
				vehicle.setEngineHp(result.getInt("engine_hp"));
				vehicle.setEngineConsum(result.getDouble("engine_consum"));
				vehicle.setPricePerDay(result.getDouble("price_per_day"));
				vehicle.setType(result.getString("type"));
				vehicle.setDoors(result.getInt("doors"));
				vehicle.setSmokers(result.getInt("smokers"));
				vehicle.setGear(result.getInt("gear"));
				vehicle.setClimatic(result.getInt("climatic"));
				vehicle.setSeats(result.getInt("seats"));
				vehicle.setNavigationSystem(result.getInt("navigation_system"));
				
				if(result.getBinaryStream("image") != null){
					vehicle.setBinaryImage(IOUtils.toByteArray(result.getBinaryStream("image")));
				}
				
				vehicles.add(vehicle);
			}
			
		} catch (ClassNotFoundException e) {
			
		} catch (SQLException e) {
			
		} catch (IOException e) {
			// TODO Auto-generated catch block
		} 
		
		Vehicle[] vehiclesArray = (Vehicle[])vehicles.toArray(new Vehicle[vehicles.size()]);
		
		return vehiclesArray;
		
	}
	
	/**
	 * Method to find a specific customer by its customer id.
	 * @param id: customer id 
	 * @return specific customer object. In case of no result in the database it returns null
	 */
	public Customer getCustomerById(int id) 
	{
			try {
				
				// getting customer from the database
				ResultSet result = DataSource.executeQuery("SELECT * FROM customers WHERE id=" + id);
				result.first();
				
				// creating a new instance of a customer
				Customer customer = new Customer();
				
				// filling customer informations
				customer.setId(result.getInt("id"));
				customer.setEmail(result.getString("email"));
				customer.setForename(result.getString("forename"));
				customer.setLastname(result.getString("lastname"));
				customer.setPhone(result.getString("phone"));
				customer.setStreet(result.getString("street"));
				customer.setCity(result.getString("city"));
				customer.setZip(result.getString("zip"));
				
				// returning the customer
				return customer;
				
			}
			catch (Exception e) {
				
				Customer customer = new Customer();
				customer.setLastname(e.getMessage()); // returning null in case of any exception thrown
				return customer;
			}
	}
	
	public Vehicle getVehicleById(int id){

		try {
			
			ResultSet result = DataSource.executeQuery("SELECT * FROM vehicles WHERE id=" + id);
			
			result.first();
			
			Vehicle v = new Vehicle();
			v.setId(result.getInt("id"));
			v.setManufacturer(result.getString("manufacturer"));
			v.setModel(result.getString("model"));
			v.setColor(result.getString("color"));
			
			if(result.getBinaryStream("image") != null){
				v.setBinaryImage(IOUtils.toByteArray(result.getBinaryStream("image")));
			}
		
			return v;
			
		} catch (ClassNotFoundException e) {
			
		} catch (SQLException e) {

		} catch (IOException e) {
			// TODO Auto-generated catch block
			//e.printStackTrace();
		}
		
		return null;
	}
	
	/**
	 * Method to register a customer. It checks if the customer already exists. 
	 * If not, it adds the customer to the database
	 * @param email
	 * @param forename
	 * @param lastname
	 * @param street
	 * @param city
	 * @param zip
	 * @param phone
	 * @return It returns if the customer has been created or not. 
	 * In case of an error it returns null.
	 * @throws ClassNotFoundException 
	 * @throws SQLException 
	 */
	public Boolean register(String email, String forename, 
			String lastname, String street, String city, 
			String zip, String phone) throws SQLException, ClassNotFoundException 
	{

				DataSource.executeNonQuery("INSERT INTO customers(email, forename, lastname, street, city, zip, phone) " +
						"VALUES('" + email + "', '" + forename + "', '" 
						+ lastname + "', '" + street + "', '" + city + "', '" + zip + "', '" + phone + "')");
				
				return true;

	}
	
	
	
	public byte[] getImage(){
		try {
			
			ResultSet result = DataSource.executeQuery("SELECT * FROM `vehicles`");
			
			
			result.first();
			
			
			return IOUtils.toByteArray(result.getBinaryStream("image"));
			
			
		} catch (ClassNotFoundException e) {
			
		} catch (SQLException e) {

		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} 
		
		return null;
		
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
