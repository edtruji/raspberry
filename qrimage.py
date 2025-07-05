import qrcode
import ipaddress
import validators
import sys
 
def is_valid_ip(ip_string):
    try:
        # Attempt to create an IP address object
        ip = ipaddress.ip_address(ip_string)        
        # Determine IP version
        if isinstance(ip, ipaddress.IPv4Address):
            return True, "IPv4"
        elif isinstance(ip, ipaddress.IPv6Address):
            return True, "IPv6"
    except ValueError:
        # Return False if the string is not a valid IP address
        return False, None
    return False, None
    
def is_valid_url(url):
    """Check if the URL is valid."""
    return validators.url(url)

def is_valid_ip(ip):
    """Check if the input is a valid IPv4 or IPv6 address."""
    try:
        ipaddress.ip_address(ip)
        return True
    except ValueError:
        return False
import qrcode
import ipaddress
import sys
import validators

def is_valid_url(url):
    """Check if the URL is valid."""
    return validators.url(url)

def is_valid_ip(ip):
    """Check if the input is a valid IPv4 or IPv6 address."""
    try:
        ipaddress.ip_address(ip)
        return True
    except ValueError:
        return False

def create_qr_code(ip, filename="qrimage.png"):
    """
    Create a QR code for the given IP address and save it as an image.
    
    Args:
        ip (str): The IP address to encode in the QR code
        filename (str): The output filename for the QR code image (fixed to qrimage.png)
    """
    # Add http:// protocol for IP address
    url = f'http://{ip}/qrimage.php'
    
    # Validate the URL
    if not is_valid_url(url):
        print("Error: Invalid IP address format")
        return
    
    # Create QR code
    qr = qrcode.QRCode(
        version=1,
        error_correction=qrcode.constants.ERROR_CORRECT_L,
        box_size=10,
        border=4,
    )
    
    # Add URL to QR code
    qr.add_data(url)
    qr.make(fit=True)
    
    # Create an image from the QR Code instance
    img = qr.make_image(fill_color="black", back_color="white")
    
    # Save the image
    try:
        img.save(filename)
        print(f"QR code saved as {filename}")
    except Exception as e:
        print(f"Error saving QR code: {e}")

def main():
    # Check for correct number of command-line arguments
    if len(sys.argv) != 2:
        print("Usage: sudo python3 qr.py <IP_ADDRESS>")
        sys.exit(1)

    # Get the ip address from the command-line arguments
    try:
        is_valid = is_valid_ip(sys.argv[1].strip())
        if is_valid:
            user_input = sys.argv[1].strip()            
        else:
            raise ValueError("The IP_ADDRESS is not valid")
    except ValueError as e:
        print(f"Error: {e}. Please provide valid ip address.")
        sys.exit(1)
        
    # Create the QR code
    create_qr_code(user_input)

if __name__ == "__main__":
    try:
        main()
    except KeyboardInterrupt:
        print("\nError")
        sys.exit(0)