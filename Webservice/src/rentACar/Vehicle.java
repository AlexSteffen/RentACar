package rentACar;

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

	private String model;
	private String other;
	private int number;
	
	
}
