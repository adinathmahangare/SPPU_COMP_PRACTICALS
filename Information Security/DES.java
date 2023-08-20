package des;
import java.io.*;
import java.util.*;
import javax.crypto.*;
import java.security.InvalidKeyException;
import java.security.NoSuchAlgorithmException;
import java.security.spec.InvalidKeySpecException;


public class DES {
	public static void main(String args[])throws IOException,
	NoSuchAlgorithmException, NoSuchPaddingException, BadPaddingException,
	InvalidKeyException, InvalidKeySpecException, IllegalBlockSizeException{
		
		try {
			//input from user
			BufferedReader bfn = new BufferedReader(new InputStreamReader(System.in));
			System.out.println("Enter the String:");
			String str = bfn.readLine();
			byte[] msg = str.getBytes();
			
			//key generation
			KeyGenerator mygenerator = KeyGenerator.getInstance("DES");
			SecretKey mydeskey = mygenerator.generateKey();
			
			//Encryption
			Cipher mycipher = Cipher.getInstance("DES");
			mycipher.init(Cipher.ENCRYPT_MODE, mydeskey);
			byte[] myEncryptedBytes = mycipher.doFinal(msg);
			String encrypteddata = new String(myEncryptedBytes);
			System.out.println("Encryted : "+ encrypteddata);
			
			//Decryption
			mycipher.init(Cipher.DECRYPT_MODE, mydeskey);
			byte[] myDecryptedBytes = mycipher.doFinal(myEncryptedBytes);
			String decrypteddata = new String(myDecryptedBytes);
			System.out.println("Decrypted : "+ decrypteddata);
			
			}
		catch(Exception e) {
			System.out.println("Exception caught!");
		}
		
		}

}
