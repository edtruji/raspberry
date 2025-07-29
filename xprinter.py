from escpos.printer import Usb

# Replace with your actual VID and PID in hexadecimal format (e.g., 0x0483, 0x5743)
# To find them on Raspberry Pi (DietPi):
# 1. Connect the printer to the USB port.
# 2. Open a terminal and run: lsusb
# 3. Look for a line mentioning "Xprinter" or a similar thermal printer device.
#    It will show something like: Bus 001 Device 003: ID xxxx:yyyy Xprinter XP-A160M
#    Here, xxxx is the VID, yyyy is the PID.
# If not listed by name, run lsusb before connecting, then after, and identify the new device.

vid = 0x2D37  # Example VID for Xprinter (0x2D37); confirm with lsusb
pid = 0x0001  # Example PID; replace with actual from lsusb (common PIDs might be 0x0001 or others)

p = Usb(vid, pid)
p.text("Hello from Grok!\n")
p.cut()