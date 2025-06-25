import RPi.GPIO as GPIO
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

try:
    # Send specified number of 50ms pulses
    for _ in range(num_pulses):
        GPIO.output(PIN, GPIO.HIGH)
        time.sleep(0.05)  # 50ms pulse
        GPIO.output(PIN, GPIO.LOW)
        time.sleep(0.05)  # 50ms gap between pulses
    print(f"Sent {num_pulses} pulses")

finally:
    # Clean up GPIO
    GPIO.cleanup()