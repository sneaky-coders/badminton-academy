// SubMenu.js
import React from 'react';
import { View, TouchableOpacity, Text, StyleSheet } from 'react-native';
import { FontAwesome5 } from '@expo/vector-icons';

const SubMenu = ({ onClose, onProfilePress, onLogoutPress }) => {
  return (
    <View style={styles.subMenuContainer}>
      <TouchableOpacity onPress={onProfilePress}>
        <Text style={styles.subMenuItem}>Profile</Text>
      </TouchableOpacity>
      <TouchableOpacity onPress={onLogoutPress}>
        <Text style={styles.subMenuItem}>Logout</Text>
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
