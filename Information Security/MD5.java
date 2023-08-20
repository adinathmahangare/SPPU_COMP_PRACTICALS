import java.io.*;
import java.util.*;
import java.math.BigInteger;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;

public class MD5 {
	public static String getMd5(String Input){
		try {
			MessageDigest md = MessageDigest.getInstance("MD5");
			byte[] mydigestbyte = md.digest(Input.getBytes());
		
			BigInteger no =  new BigInteger(1, mydigestbyte);
			String hashtext = no.toString(16);
		
			while (hashtext.length() < 32) {
				hashtext = hashtext + "0";
			}
			return hashtext;
		}
		catch (NoSuchAlgorithmException e) {
			throw new RuntimeException(e);
		}
		
	}
	
	public static void main(String args[]) throws NoSuchAlgorithmException{
		System.out.println("Enter the Text : ");
		Scanner sc = new Scanner(System.in);
		String s = sc.next();
		System.out.println("Your MD5 hash value : "+getMd5(s));
		
	}
}
