package rentACar;

/**
 * 
 * @author E.Braun
 * This class represents a renting.
 */
public class Renting {
	
	private int id;
	private int vehicleId;
	private int customerId;
	private String startDate;
	private String returnDate;
	private double totalPrice;
	private int rating;
	
	public int getId() {
		return id;
	}
	
	public void setId(int id) {
		this.id = id;
	}
	
	public int getVehicleId() {
		return vehicleId;
	}
	
	public void setVehicleId(int vehicleId) {
		this.vehicleId = vehicleId;
	}
	
	public int getCustomerId() {
		return customerId;
	}
	
	public void setCustomerId(int customerId) {
		this.customerId = customerId;
	}
	
	public String getStartDate() {
		return startDate;
	}
	
	public void setStartDate(String startDate) {
		this.startDate = startDate;
	}
	

	public String getReturnDate() {
		return returnDate;
	}

	public void setReturnDate(String returnDate) {
		this.returnDate = returnDate;
	}

	public double getTotalPrice() {
		return totalPrice;
	}

	public void setTotalPrice(double totalPrice) {
		this.totalPrice = totalPrice;
	}

	public int getRating() {
		return rating;
	}

	public void setRating(int rating) {
		this.rating = rating;
	}
	
}
