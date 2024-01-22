// SubMenu.js
import React from 'react';
import { View, TouchableOpacity, Text, StyleSheet } from 'react-native';
import { FontAwesome5 } from '@expo/vector-icons';

const SubMenu = ({ onClose, onProfilePress, onLogoutPress }) => {
  const color = 'yourColorValue'; // Replace with your color value
  const size = 20; // Replace with your desired size value

  return (
    <View style={styles.subMenuContainer}>
      <TouchableOpacity onPress={onProfilePress}>
        <Text style={styles.subMenuItem}>
          <FontAwesome5 name="home" color={color} size={size} /> Profile
        </Text>
      </TouchableOpacity>
      <TouchableOpacity onPress={onLogoutPress}>
        <Text style={styles.subMenuItem}>
        <FontAwesome5 name="sign-out-alt" color={color} size={size} />Logout
        </Text>
      </TouchableOpacity>

      {/* Testing button to trigger onClose directly */}
      <TouchableOpacity onPress={onClose}>
        <Text style={styles.closeButton}>
        <FontAwesome5 name="times" color={color} size={size} />Close
        </Text>
      </TouchableOpacity>
    </View>
  );
};

const styles = StyleSheet.create({
  subMenuContainer: {
    position: 'absolute',
    top: 60,
    right: 10,
    backgroundColor: 'white',
    borderRadius: 5,
    padding: 10,
    elevation: 5,
  },
  subMenuItem: {
    fontSize: 16,
    marginBottom: 10,
    color: '#3498db',
  },
  closeButton: {
    fontSize: 16,
    color: 'red',
  },
});

export default SubMenu;
