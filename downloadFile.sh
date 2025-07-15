#!/bin/bash

# Check if an argument was provided
if [ $# -eq 0 ]; then
    echo "Error: Please provide a filename as an argument"
    echo "Usage: $0 <FileName>"
    exit 1
fi

# Check if wget is installed
if ! command -v wget &> /dev/null; then
    echo "Error: wget is not installed. Please install wget and try again."
    exit 1
fi

# Store the filename from the first argument
FILENAME=$1
URL="https://raw.github.com/edtruji/raspberry/main/$FILENAME"

# Check if the file exists at the URL (using wget --spider)
wget --spider "$URL" 2>/dev/null
if [ $? -ne 0 ]; then
    echo "Error: File $FILENAME not found at $URL"
    exit 1
fi

# Download the file using wget
wget -O "$FILENAME" "$URL"

# Check if the download was successful
if [ $? -eq 0 ]; then
    echo "File $FILENAME downloaded successfully"
else
    echo "Error: Failed to download $FILENAME"
    exit 1
fi