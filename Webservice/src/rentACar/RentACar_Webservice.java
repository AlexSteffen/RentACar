package rentACar;

import java.io.IOException;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

import model.Customer;
import model.Location;
import model.Renting;
import model.Vehicle;

import org.apache.commons.io.IOUtils;

import core.DataSource;


public class RentACar_Webservice {
	
	/**
	 * This is the default contructor that is required for an Axis2-Webservice
	 */
	public RentACar_Webservice() 
	{	
	}
	
	/**
	 * Returns the location by the passed id.
	 * @param id ID of the location.
	 * @return Object of a type location.
	 */
	public Location getLocationById(int id){
		
		try {
			//SQL-Query to find out the corresponding location
			ResultSet result = DataSource.executeQuery("SELECT * FROM locations WHERE id=" + id);
						
			// create a location object from the result
			result.first();
			Location location = new Location();
			location.setId(result.getInt("id"));
			location.setCity(result.getString("city"));
			location.setZip(result.getString("zip"));
			location.setStreet(result.getString("street"));
			location.setPhone(result.getString("phone"));
			location.setEmail(result.getString("email"));
	
			//return the location
			return location;
			
		} catch (ClassNotFoundException e) {
			//returns null in error case
			return null;
		} catch (SQLException e) {
			//returns null in error case
			return null;
		}

	}

	/**
	 * Returns all existing locations.
	 * @return Array of locations.
	 */
	public Location[] getAllLocations(){
		
		ArrayList<Location> locations = new ArrayList<Location>();
		
		try {
			//SQL-Query to find out all locations
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
			//returns null in error case
			return null;
		} catch (SQLException e) {
			//returns null in error case
			return null;
		}
		
		//converts the ArrayList to an array. This is required because AXIS2 can not transport generic lists over SOAP
		Location[] locationsArray = locations.toArray(new Location[locations.size()]);
		
		return locationsArray;
	}
	
	/**
	 * Method to return a vehicle by its id.
	 * @param id ID of the vehicle.
	 * @return Object of a type vehicle.
	 */
	public Vehicle getVehicleById(int id){
	
		try {
			//SQL-Query to find out the requested vehicle
			ResultSet result = DataSource.executeQuery("SELECT * FROM vehicles WHERE id=" + id);
			
			result.first();
			
			//creates an object from the record
			Vehicle vehicle = new Vehicle();
			
			vehicle.setId(result.getInt("id"));
			vehicle.setLocationId(result.getInt("location_id"));
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
			
			//the image has a binary format an will be converted to a byte-array
			if(result.getBinaryStream("image") != null){
				vehicle.setBinaryImage(IOUtils.toByteArray(result.getBinaryStream("image")));
			}
			
			return vehicle;
			
		} catch (ClassNotFoundException e) {
			//returns null in error case
			return null;
		} catch (SQLException e) {
			//returns null in error case
			return null;
		} catch (IOException e) {
			//returns null in error case
			return null;
		}
	}

	/**
	 * This webservice method finds all available vehicles to the passed start and return parameters
	 * @param startDate The start of the renting (date and time).
	 * @param startLocation The location where the vehicle will be taken.
	 * @param returnDate The return of the renting (date and time)
	 * @return An Array of available vehicles.
	 */
	public Vehicle[] findVehicles(String startDate, int startLocation, String returnDate){
		ArrayList<Vehicle> vehicles = new ArrayList<Vehicle>();
		
		//In this query is the logic implemented that only cars are found if they are available
		//in the requested timeframe
		String query = 	"SELECT * FROM vehicles "+ 
						"WHERE " +
						"location_id=" + startLocation + " " +
						"AND NOT EXISTS " +
						"("+
							"SELECT * FROM rentings WHERE "+
							"vehicle_id = vehicles.id "+
							"AND ("+
							"('"+startDate+"' BETWEEN start_date AND return_date OR '"+returnDate+"' BETWEEN start_date AND return_date) "+
							"OR "+
							"('"+startDate+"' < start_date AND '"+returnDate+"' > return_date))" +
						")";
		
		try {	
			//SQL-Query to find out the available vehicles
			ResultSet result = DataSource.executeQuery(query);
	
			//creates an object from every record
			while(result.next()) {
				Vehicle vehicle = new Vehicle();
				
				vehicle.setId(result.getInt("id"));
				vehicle.setLocationId(result.getInt("location_id"));
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
					//convert the image (blob) from the database in a bytearray. 
					vehicle.setBinaryImage(IOUtils.toByteArray(result.getBinaryStream("image")));
				}
				
				vehicles.add(vehicle);
			}
			
		} catch (ClassNotFoundException e) {
			//returns null in error case
			return null;
		} catch (SQLException e) {
			//returns null in error case
			return null;
		} catch (IOException e) {
			//returns null in error case
			return null;
		} 
		
		//converts an ArrayList to an array
		Vehicle[] vehiclesArray = (Vehicle[])vehicles.toArray(new Vehicle[vehicles.size()]);
		
		return vehiclesArray;
		
	}

	/**
	 * This Method deals with verification if a vehicle is available in the passed timeframe.
	 * @param vehicleId ID of the vehicle.
	 * @param startDate The start of the renting (date and time).
	 * @param returnDate The return of the renting (date and time).
	 * @return Returns TRUE if the vehicle is available.
	 */
	public Boolean isVehicleAvailable(int vehicleId, String startDate, String returnDate){
		
		//This query checks if the vehicle is available in the specified timeframe
		String query = 	"SELECT count(*) as anzahl FROM rentings WHERE " +
						"vehicle_id = "+ vehicleId + " " +
						"AND " +
						"("+
						"('"+startDate+"' BETWEEN start_date AND return_date OR '"+returnDate+"' BETWEEN start_date AND return_date) "+
						"OR "+
						"('"+startDate+"' < start_date AND '"+returnDate+"' > return_date) " +
						")";
		
		try {		
			ResultSet result = DataSource.executeQuery(query);
			
			result.first();
			
			if(result.getInt("anzahl") > 0){
				return false;
			}else{
				return true;
			}
			
		}catch(Exception e){
			return false;
		}
	
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
				customer.setPassword(result.getString("password"));
				customer.setEmail(result.getString("email"));
				customer.setSalutation(result.getString("salutation"));
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
	
	/***
	 * This method checks if a customer already exists by id.
	 * @param email 
	 * @return It returns a boolean whether it exists or not.
	 */
	public Boolean customerExists(String email)
	{
		try {
			
			// checking the email-address in the database
			ResultSet result = DataSource.executeQuery("SELECT * FROM customers WHERE email='" + email + "'");
			Boolean exists = result.first();
	
			return exists;
			
		}  catch (Exception e) {
			
			// returns null in case of an error
			return null;
		}
	}

	/***
	 * Checks if a email address is already in the database.
	 * @param email address of potential customer
	 * @param the customers password
	 * @return Customer-Object in case of positive match of email address and password. Otherwise, or in case of errors it returns null.
	 */
	public Customer checkLogin(String email, String password)
	{
		try {	
		
			// getting a customer with a specific email address from the database
			ResultSet result = DataSource.executeQuery("SELECT * FROM customers WHERE email='" + email + "'");
			
			if (result.next()) 
			{	
				// creating a new instance of a customer
				Customer customer = new Customer();
				
				// filling customer informations
				customer.setId(result.getInt("id"));
				customer.setEmail(result.getString("email"));
				customer.setSalutation(result.getString("salutation"));
				customer.setForename(result.getString("forename"));
				customer.setLastname(result.getString("lastname"));
				customer.setPhone(result.getString("phone"));
				customer.setStreet(result.getString("street"));
				customer.setCity(result.getString("city"));
				customer.setZip(result.getString("zip"));
				customer.setPassword(result.getString("password"));
				
				// checking if the entered password matches to the customer
				// in case of matching: returning the customer-instance
				// in all other cases: returning null
				if(customer.getPassword().equals(password))
				{
					return customer;
				}
				else
				{
					return null;
				}
			}
			else 
			{
				return null;
			}
		} catch (Exception e) {
			return null;
		}
	}
	
	
	/***
	 * Getting the rating for a specific vehicle.
	 * @param vehicle id
	 * @return rating as a double
	 */
	public double getRating(int vehicleId)
	{
		int number = 0;
		double sum = 0;
		double rating = 0;
		
		try 
		{
			// getting each renting from the rentings table where the specific vehicle was used
			ResultSet result = DataSource.executeQuery("SELECT * FROM rentings WHERE vehicle_id=" + vehicleId);
			
			if (result != null) 
			{
				// sum up the ratings and count the number of ratings
				while (result.next()) 
				{
					// only sum up ratings with a minimum value of 1 and only count those
					if(result.getDouble("rating") != 0)
					{
						sum += result.getDouble("rating");
						number++;
					}
				}
				
				// prohibit division by zero
				if(number != 0)
				{
					// calculate the rating
					rating = sum / number;
				}
			}
			
			return rating;
			
		} catch (Exception e) {
	
			return rating;
		}
	}

	/***
	 * Adding a rating to a vehicle. Max value for a rating is 5.
	 * @param id of the renting which should be rated
	 * @param rating value
	 */
	public void doRating(int customerId, int rentingId, int ratingValue) 
	{
		try 
		{
			// catch wrong values
			if(ratingValue < 1)
				ratingValue = 0;
			else if(ratingValue >4)
				ratingValue = 5;
			
			// updating the database with the new rating value
			DataSource.executeNonQuery("UPDATE rentings " +
					"SET rating=" + ratingValue + " WHERE id=" + rentingId + " AND customer_id="+customerId+" AND rating=0");
			
					
		} catch (Exception e) 
		{

		}
	}
	
	/***
	 * Getting all rentings of a customer.
	 * @param customerId
	 * @return an array of rentings 
	 */
	public Renting[] getRentingsByCustomerId(int customerId)
	{
		// creating an ArrayList-instance 
		ArrayList<Renting> rentings = new ArrayList<Renting>();
		
		try 
		{
			// getting all rentings of a customer from the database
			ResultSet result = DataSource.executeQuery("SELECT id," +
														"vehicle_id, " +
														"customer_id, " +
														"DATE_FORMAT(start_date, '%Y-%m-%d %H:%i:%s') as start_date, " +
														"DATE_FORMAT(return_date, '%Y-%m-%d %H:%i:%s') as return_date, " +
														"total_price, " +
														"rating " +
														"FROM rentings WHERE customer_id=" + customerId);
			
			// adding all rentings to the ArrayList
			while(result.next())
			{
				Renting renting = new Renting();
				
				renting.setId(result.getInt("id"));
				renting.setVehicleId(result.getInt("vehicle_id"));
				renting.setCustomerId(result.getInt("customer_id"));
				renting.setStartDate(result.getString("start_date"));
				renting.setReturnDate(result.getString("return_date"));
				renting.setTotalPrice(result.getDouble("total_price"));
				renting.setRating(result.getInt("rating"));
				
				rentings.add(renting);
			}
			
		} catch (Exception e) {
			// TODO: handle exception
		}
		
		// converting the ArrayList into an Array
		Renting[] rentingArray = (Renting[])rentings.toArray(new Renting[rentings.size()]);
		
		return rentingArray;
		
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
	public Boolean doRegistration(String email,String password, String salutation, String forename, 
			String lastname, String street, String city, 
			String zip, String phone) throws SQLException, ClassNotFoundException 
	{
		
		if(!customerExists(email))
		{
				DataSource.executeNonQuery("INSERT INTO customers (`email`, `password`, `salutation`, `forename`, " +
						"`lastname`, `street`, `zip`, `city`, `phone`) " +
						"VALUES('" + email + "', '" + password + "', '" + salutation + "', '" + forename + "', '" 
						+ lastname + "', '" + street + "', '" + zip + "', '" + city + "', '" + phone + "')");
				
				return true;
		}
		else
		{
			return false;
		}
	}

	/***
	 * Method to do a reservation.
	 * @param vehicle id
	 * @param customer Id 
	 * @param startDate
	 * @param returnDate
	 * @param totalPrice
	 * @return It returns the renting
	 */			   
	public Renting doReservation(int vehicleId, int customerId, String startDate, String returnDate, double totalPrice)
	{
		try {
			
			if(isVehicleAvailable(vehicleId, startDate, returnDate)){
				int rentingId = DataSource.executeInsert("INSERT INTO rentings " +
						"(vehicle_id, customer_id, start_date, return_date, total_price) " +
						"VALUES(" + vehicleId + ", " + customerId + ", '" + startDate + "', '" + returnDate + "'" +
								", " + totalPrice + ")");
				
	
				ResultSet result = DataSource.executeQuery("SELECT * FROM rentings WHERE id=" + rentingId);
				
				result.first();
				
				Renting renting = new Renting();
				
				renting.setId(result.getInt("id"));
				renting.setVehicleId(result.getInt("vehicle_id"));
				renting.setCustomerId(result.getInt("customer_id"));
				renting.setStartDate(result.getString("start_date"));
				renting.setReturnDate(result.getString("return_date"));
				renting.setTotalPrice(result.getDouble("total_price")); 
				
				return renting;
			}else{
				
				return null;
			}
			
			
		} 
		catch (Exception e) 
		{
			Renting renting = new Renting();
			renting.setReturnDate(e.getMessage()); 
			
			return renting;
			
			//return null;
		}
	}
}
