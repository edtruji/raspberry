from escpos.printer import Usb

# VID and PID from your lsusb output
vid = 0x0483
pid = 0x5743

# Initialize the USB printer
p = Usb(vid, pid)

# Set the media width for an 80mm printer (576 pixels at 203 DPI)
p._raw(b'\x1D\x57\x40\x02')  # GS W command: Set printing area width to 576 pixels (0x0240)

# Print a QR code
p.text("QR Code Example:\n")
p.qr("https://endi.com", size=8)  # URL for the QR code; adjust size (1-10) as needed

# Add some spacing
p.text("\n\n")

# Print a barcode (CODE128 with explicit subset C for numeric data)
p.text("Barcode Example (Code 128):\n")
p._raw(b'\x1B\x61\x01')  # ESC a 1: Center alignment
p.barcode("{C1234567890", "CODE128", height=80, width=3, pos="BELOW")  # Use {C for numeric data
p._raw(b'\x1B\x61\x00')  # ESC a 0: Reset to left alignment

# Cut the paper
p.cut()

# Close the printer connection
p.close()