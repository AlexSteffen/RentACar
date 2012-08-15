package rentACar;

import java.io.InputStream;

/**
 * 
 * @author G.Boeselager
 * This class represents a vehicle. 
 */
public class Vehicle {

	public String getModel() {
		return model;
	}
	public void setModel(String model) {
		this.model = model;
	}

	public String getOther() {
		return other;
	}

	public void setOther(String other) {
		this.other = other;
	}

	public int getNumber() {
		return number;
	}

	public void setNumber(int number) {
		this.number = number;
	}

	public String getImage() {
		return image;
	}
	public void setImage(String image) {
		this.image = image;
	}

	public InputStream getBinaryImage() {
		return binaryImage;
	}
	public void setBinaryImage(InputStream binaryImage) {
		this.binaryImage = binaryImage;
	}

	private String model;
	private String other;
	private String image;
	private InputStream binaryImage;
	private int number;
	
	
}
