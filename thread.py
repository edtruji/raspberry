import threading
import time

# Define a function for the thread to execute
def my_task(name):
    print(f"Thread {name} starting")
    time.sleep(2)  # Simulate some work
    print(f"Thread {name} finished")

# Create a new thread
thread = threading.Thread(target=my_task, args=("A",))

# Start the thread
thread.start()

# Wait for the thread to complete (optional)
thread.join()

print("Main program finished")