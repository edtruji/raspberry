import sqlite3
import sys

def validate_user(passcode):
    try:
        # Convert passcode to integer and validate it's a 4-digit number
        passcode = int(passcode)
        if not (1000 <= passcode <= 9999):
            return "Error: Passcode must be a 4-digit number"

        # Connect to the database
        conn = sqlite3.connect('amusement.db')
        cursor = conn.cursor()

        # Query to find user with the given passcode
        cursor.execute("SELECT name FROM users WHERE passcode = ?", (passcode,))
        result = cursor.fetchone()

        # Close the connection
        conn.close()

        # Check if a user was found
        if result:
            return result[0]  # Return the name
        else:
            return "Error: No user found with this passcode"

    except ValueError:
        return "Error: Passcode must be a valid number"
    except sqlite3.Error as e:
        return f"Error: Database error - {e}"

if __name__ == "__main__":
    # Check if passcode argument is provided
    if len(sys.argv) != 2:
        print("Error: Please provide a 4-digit passcode as an argument")
        sys.exit(1)

    # Get the passcode from command-line argument
    passcode = sys.argv[1]
    result = validate_user(passcode)
    print(result)