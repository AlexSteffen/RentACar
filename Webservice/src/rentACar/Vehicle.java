package rentACar;

/**
 * 
 * @author G.Boeselager
 * This class represents a vehicle. 
 */
public class Vehicle {

	private int id;
	private String manufacturer;
	private String model;
	private String color;
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

	
	
}
