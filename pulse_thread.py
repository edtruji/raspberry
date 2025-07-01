import RPi.GPIO as GPIO
import threading
import time
import sys

# Check if an argument is provided
if len(sys.argv) != 2:
    print("Usage: sudo python3 pulse.py <number_of_pulses>")
    sys.exit(1)

try:
    num_pulses = int(sys.argv[1])
    if num_pulses <= 0:
        raise ValueError("Number of pulses must be positive")
except ValueError:
    print("Error: Please provide a valid positive integer")
    sys.exit(1)

# Set up GPIO using BOARD numbering
GPIO.setmode(GPIO.BOARD)

# Define PIN 7 (board pinout)
PIN = 7

# Set up PIN as output
GPIO.setup(PIN, GPIO.OUT)

# Define the pulse-sending function for the thread
def send_pulses(num_pulses):
    try:
        # Send specified number of 50ms pulses
        for i in range(num_pulses):
            GPIO.output(PIN, GPIO.HIGH)
            time.sleep(0.05)  # 50ms pulse
            GPIO.output(PIN, GPIO.LOW)
            time.sleep(0.05)  # 50ms gap between pulses
        print(f"Sent {num_pulses} pulses")
    finally:
        # Clean up GPIO in the thread
        GPIO.cleanup()

try:
    # Create a thread for sending pulses
    pulse_thread = threading.Thread(target=send_pulses, args=(num_pulses,))
    
    # Start the thread
    pulse_thread.start()
    
    # Wait for the thread to complete
    pulse_thread.join()
    
    print("Main program finished")

except KeyboardInterrupt:
    print("\nProgram interrupted by user")
    # Thread handles GPIO cleanup
    sys.exit(0)
except Exception as e:
    print(f"Error: {e}")
    # Thread handles GPIO cleanup
    sys.exit(1)