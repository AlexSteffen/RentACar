package rentACar;

import java.sql.ResultSet;
import java.sql.SQLException;

public class Customer {

	private int id;
	private String email;
	private String forename;
	private String lastname;
	private String phone;
	private String street;
	private String zip;
	private String city;
	
	// Getter and setter methodes 
	
	public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
	}
	public String getEmail() {
		return email;
	}
	public void setEmail(String email) {
		this.email = email;
	}
	public String getForename() {
		return forename;
	}
	public void setForename(String forename) {
		this.forename = forename;
	}
	public String getLastname() {
		return lastname;
	}
	public void setLastname(String lastname) {
		this.lastname = lastname;
	}
	public String getPhone() {
		return phone;
	}
	public void setPhone(String phone) {
		this.phone = phone;
	}
	public String getStreet() {
		return street;
	}
	public void setStreet(String street) {
		this.street = street;
	}
	public String getZip() {
		return zip;
	}
	public void setZip(String zip) {
		this.zip = zip;
	}
	public String getCity() {
		return city;
	}
	public void setCity(String city) {
		this.city = city;
	}
	
	/***
	 * This method checks if a customer already exists by id.
	 * @param email 
	 * @return It returns a boolean wheater it exists or not.
	 */
	public static Boolean exists(String email)
	{
		try {
			
			// checking the email-address in the database
			ResultSet result = DataSource.executeQuery("SELECT * FROM customers WHERE email=" + email);
			Boolean exists = result.first();
	
			return exists;
			
		}  catch (Exception e) {
			
			// returns null in case of an error
			return null;
		}
	}
	

	
}
