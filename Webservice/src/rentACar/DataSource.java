package rentACar;
import java.sql.*;

/**
 *  
 * This class contains a few methods for dealing with the MySQL-database.
 * Every interaction with the database will be handled by static methods of this class.
 * @author a.steffen
 *
 */
public class DataSource {
	/**
	 * Method to get the connection to the database.
	 * @return Connection to the database.
	 * @throws ClassNotFoundException
	 */
	public static Connection getConnection()
		throws ClassNotFoundException, SQLException{

			try {
				//check, if the MySQL JDBC driver is installed. In the other case throw ClassNotFoundException!  
				Class.forName("com.mysql.jdbc.Driver");
				
				//create connection to the database and return a connection-object on success.
				Connection con;
				
				con = DriverManager.getConnection("jdbc:mysql://localhost/rentacar", "root", "");
		
				
				return con;
				
			}catch (ClassNotFoundException e) {
				throw new SQLException("Datenbanktreiber (JAVA JDBC) ist nicht vorhanden.");
			}catch (SQLException e) {
				throw new SQLException("Datenbankverbindung fehlgeschlagen. "+ e.getMessage());
			}	
	}
	
	/**
	 * Wrapper for executing a simple SQL-query.
	 * @param query: SQL-query string 
	 * @return a ResultSet which contains the queried information
	 * @throws SQLException 
	 * @throws ClassNotFoundException 
	 */
	public static ResultSet executeQuery(String query) 
		throws ClassNotFoundException, SQLException{
		
		//database connection
		Connection con = DataSource.getConnection();
		
		//create a SQL statement
		Statement stmt = con.createStatement();
		
		//execute query now
		ResultSet result = stmt.executeQuery(query);
		
		return result;
	}

	/**
	 * Executes a statement, which might be an INSERT, UPDATE or DELETE statement.
	 * Call this method if you do not expect a returning ResultSet from the database.
	 * @param statement: SQL-statement string
	 * @throws SQLException
	 * @throws ClassNotFoundException
	 */
	public static void executeNonQuery(String statement) 
		throws SQLException, ClassNotFoundException{
		
		//database connection
		Connection con = DataSource.getConnection();
		
		//create a SQL statement
		Statement stmt = con.createStatement();
		
		//execute the statement now
		stmt.executeUpdate(statement);
		
		//close the database connection 
		con.close();
	}
}
