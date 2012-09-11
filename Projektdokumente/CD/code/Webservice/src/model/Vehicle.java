package model;

/**
 * Class which represents a vehicle.
 * @author A.Steffen
 *
 */
public class Vehicle {

	private int id;
	private int locationId;
	private String manufacturer;
	private String model;
	private String color;
	private String engineType;
	private double engineSize;
	private int engineHp;
	private double engineConsum;
	private double pricePerDay;
	private String type;
	private int doors;
	private int smokers;
	private int gear;
	private int climatic;
	private int seats;
	private int navigationSystem;
	private byte[] binaryImage;
	
	public String getModel() {
		return model;
	}
	public void setModel(String model) {
		this.model = model;
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public byte[] getBinaryImage() {
		return binaryImage;
	}
	
	public void setBinaryImage(byte[] binaryImage) {
		this.binaryImage = binaryImage;
	}
	
	public String getManufacturer() {
		return manufacturer;
	}
	
	public void setManufacturer(String manufacturer) {
		this.manufacturer = manufacturer;
	}
	
	public String getColor() {
		return color;
	}
	
	public void setColor(String color) {
		this.color = color;
	}
	
	public String getEngineType() {
		return engineType;
	}
	
	public void setEngineType(String engineType) {
		this.engineType = engineType;
	}
	
	public double getEngineSize() {
		return engineSize;
	}
	
	public void setEngineSize(double engineSize) {
		this.engineSize = engineSize;
	}
	
	public int getEngineHp() {
		return engineHp;
	}
	
	public void setEngineHp(int engineHp) {
		this.engineHp = engineHp;
	}
	
	public double getEngineConsum() {
		return engineConsum;
	}
	
	public void setEngineConsum(double engineConsum) {
		this.engineConsum = engineConsum;
	}
	
	public double getPricePerDay() {
		return pricePerDay;
	}
	
	public void setPricePerDay(double pricePerDay) {
		this.pricePerDay = pricePerDay;
	}
	
	public String getType() {
		return type;
	}
	
	public void setType(String type) {
		this.type = type;
	}
	
	public int getDoors() {
		return doors;
	}
	
	public void setDoors(int doors) {
		this.doors = doors;
	}
	
	public int getSmokers() {
		return smokers;
	}
	
	public void setSmokers(int smokers) {
		this.smokers = smokers;
	}
	
	public int getGear() {
		return gear;
	}
	
	public void setGear(int gear) {
		this.gear = gear;
	}
	
	public int getClimatic() {
		return climatic;
	}
	
	public void setClimatic(int climatic) {
		this.climatic = climatic;
	}
	
	public int getSeats() {
		return seats;
	}
	
	public void setSeats(int seats) {
		this.seats = seats;
	}
	
	public int getNavigationSystem() {
		return navigationSystem;
	}
	
	public void setNavigationSystem(int navigationSystem) {
		this.navigationSystem = navigationSystem;
	}
	public int getLocationId() {
		return locationId;
	}
	public void setLocationId(int locationId) {
		this.locationId = locationId;
	}
}
