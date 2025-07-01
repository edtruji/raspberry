import RPi.GPIO as GPIO
import threading
import time
import sys

# Check for correct number of command-line arguments
if len(sys.argv) != 3:
    print("Usage: sudo python3 pulse_thread.py <num_pulses_pin13> <num_pulses_pin15>")
    sys.exit(1)

# Get number of pulses from command-line arguments
try:
    num_pulses_pin13 = int(sys.argv[1])
    num_pulses_pin15 = int(sys.argv[2])
    if num_pulses_pin13 < 0 or num_pulses_pin15 < 0:
        raise ValueError("Number of pulses must be non-negative")
except ValueError as e:
    print(f"Error: {e}. Please provide valid non-negative integers.")
    sys.exit(1)

# Set up GPIO mode
GPIO.setmode(GPIO.BOARD)

# Define the GPIO pins (BOARD numbering)
PIN_1 = 13  # Physical pin 33
PIN_2 = 15  # Physical pin 10

# Set up the pins as output
GPIO.setup(PIN_1, GPIO.OUT)
GPIO.setup(PIN_2, GPIO.OUT)

def pulse_pin(pin, num_pulses):
    """Function to pulse a single pin for a specified number of 50ms high/50ms low pulses."""
    for _ in range(num_pulses):
        GPIO.output(pin, GPIO.HIGH)
        time.sleep(0.050)  # 50ms high
        GPIO.output(pin, GPIO.LOW)
        time.sleep(0.050)  # 50ms low

def main():
    # Create threads for each pin
    thread1 = threading.Thread(target=pulse_pin, args=(PIN_1, num_pulses_pin13))
    thread2 = threading.Thread(target=pulse_pin, args=(PIN_2, num_pulses_pin15))

    # Start the threads
    print(f"Starting {num_pulses_pin13} pulses on PIN 13 and {num_pulses_pin15} pulses on PIN 15...")
    start_time = time.time()
    thread1.start()
    thread2.start()

    # Wait for threads to complete
    thread1.join()
    thread2.join()

    # Calculate and print total runtime
    runtime = time.time() - start_time
    print(f"Pulsing completed in {runtime:.2f} seconds.")

    # Cleanup GPIO
    GPIO.cleanup()
    print("GPIO cleanup completed.")

if __name__ == "__main__":
    try:
        main()
    except KeyboardInterrupt:
        print("\nProgram interrupted. Cleaning up GPIO...")
        GPIO.cleanup()
        sys.exit(0)