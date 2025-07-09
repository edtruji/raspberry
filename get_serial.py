import hashlib
import re
import subprocess

def get_mac_address():
    try:
        # Get MAC address from network interface
        result = subprocess.check_output(['cat', '/sys/class/net/wlan0/address']).decode('utf-8').strip()
        # Remove colons from MAC address
        mac = result.replace(':', '')
        return mac
    except subprocess.CalledProcessError:
        return None

def get_motherboard_serial():
    try:
        # Read CPU info to get serial number
        with open('/proc/cpuinfo', 'r') as f:
            for line in f:
                if line.startswith('Serial'):
                    serial = line.split(':')[1].strip()
                    return serial
        return None
    except FileNotFoundError:
        return None

def generate_serial_number():
    # Get MAC and serial
    mac = get_mac_address()
    serial = get_motherboard_serial()
    
    if not mac or not serial:
        return "Error: Could not retrieve MAC address or serial number"
    
    # Combine MAC and serial
    combined = mac + serial
    
    # Create SHA-256 hash
    hasher = hashlib.sha256()
    hasher.update(combined.encode('utf-8'))
    serial_number = hasher.hexdigest()
    
    return serial_number

def main():
    serial_number = generate_serial_number()
    print(f"Generated Serial Number: {serial_number}")

if __name__ == "__main__":
    main()