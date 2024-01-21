// ProfileScreen.js
import React from 'react';
import { View, Text, StyleSheet, Image, ImageBackground, ScrollView } from 'react-native';

const ProfileScreen = () => {
  // Define static user data
  const user = {
    name: 'John Doe',
    email: 'john.doe@example.com',
    contact: '123-456-7890',
    address: '123 Main St, Cityville',
    username: 'admin@example.com',
    password: 'admin@123',
    dob: '5 June 1997',
    // Add more static user details as needed
  };
  const backgroundImage = require("../assets/bg3.png");

  return (
    <ImageBackground source={backgroundImage} style={styles.backgroundImage}>
      <ScrollView contentContainerStyle={styles.container}>
        <Image source={require("../assets/admin.jpg")} style={styles.profilePicture} />
        <Text style={styles.title}>User Profile</Text>

        <View style={styles.userInfo}>
          <Text>Name: {user.name}</Text>
        </View>

        <View style={styles.userInfo}>
          <Text>Email: {user.email || 'Not provided'}</Text>
        </View>

        <View style={styles.userInfo}>
          <Text>Contact: {user.contact}</Text>
        </View>

        <View style={styles.userInfo}>
          <Text>Address: {user.address}</Text>
        </View>

        <View style={styles.userInfo}>
          <Text>Username: {user.username}</Text>
        </View>

        <View style={styles.userInfo}>
          <Text>Password: {user.password}</Text>
        </View>

        <View style={styles.userInfo}>
          <Text>DOB: {user.dob}</Text>
        </View>
      </ScrollView>
    </ImageBackground>
  );
};

const styles = StyleSheet.create({
  backgroundImage: {
    flex: 1,
    resizeMode: 'cover',
  },
  container: {
    alignItems: 'center',
    padding: 20,
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    marginVertical: 10,
    color: 'white',
  },
  profilePicture: {
    width: 100,
    height: 100,
    borderRadius: 50,
    marginBottom: 10,
  },
  userInfo: {
    backgroundColor: 'white',
    padding: 20,
    borderRadius: 10,
    elevation: 5,
    width: '100%',
    marginBottom: 10,
  },
});

export default ProfileScreen;