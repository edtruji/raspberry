from escpos.printer import Usb

# VID and PID from your lsusb output
vid = 0x0483
pid = 0x5743

# Initialize the USB printer
p = Usb(vid, pid)

# Set the media width for an 80mm printer (576 pixels at 203 DPI)
p._raw(b'\x1D\x77\x40\x02')  # ESC/POS command to set paper width (576 pixels = 0x0240 in hex)
# Note: This is a low-level command; adjust if your printer uses a different DPI or width

# Print a QR code
p.text("QR Code Example:\n")
p.qr("https://cnn.com", size=8)  # URL for the QR code; adjust size (1-10) as needed

# Add some spacing
p.text("\n\n")

# Print a barcode (using CODE39 instead of CODE128 for simplicity)
p.text("Barcode Example (Code 39):\n")
p.barcode("1234567890", "CODE39", height=80, width=3, pos="BELOW", align_ct=True)

# Cut the paper
p.cut()

# Close the printer connection
p.close()