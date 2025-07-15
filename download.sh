#!/bin/bash

# Check if an argument was provided
if [ $# -eq 0 ]; then
    echo "Error: Please provide a filename as an argument"
    echo "Usage: $0 <FileName>"
    exit 1
fi

# Store the filename from the first argument
FILENAME=$1

# Download the file using wget
wget -O "$FILENAME" "https://raw.github.com/edtruji/raspberry/main/$FILENAME"

# Check if the download was successful
if [ $? -eq 0 ]; then
    echo "File $FILENAME downloaded successfully"
else
    echo "Error: Failed to download $FILENAME"
    exit 1
fi